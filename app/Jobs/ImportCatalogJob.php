<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\Collection;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Lunar\Models\Price;

class ImportCatalogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public string $filePath;
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $xml = simplexml_load_file($this->filePath);
            $collectionIndex = [];           // guid  => collection_id
            $this->importGroups(
                $xml->Классификатор->Группы->Группа ?? [],
                null,
                $collectionIndex
            );

            /** --------- 3. Товары --------- */
            foreach ($xml->Каталог->Товары->Товар ?? [] as $item) {
                $this->importProduct($item, $collectionIndex);
            }
        info("CML-debug: файл принят, расположен в {$this->filePath}");
    }
    private function importGroups($groupsXml, ?int $parentId, array &$index): void
    {
        foreach ($groupsXml as $groupXml) {
            $guid = (string)$groupXml->Ид;
            $name = (string)$groupXml->Наименование;
            $parent = $parentId ? Collection::find($parentId) : null;
            if ($parentId) {
                $collection = Collection::updateOrCreate(
                    ['external_id' => $guid],
                    [
                        'attribute_data' => [
                            'name' => new \Lunar\FieldTypes\Text($name.'a'),
                        ],
                        'collection_group_id' => $parent->getGroupId(),
                    ]
                );
            } else {
                $collectionGroup = \Lunar\Models\CollectionGroup::updateOrCreate(
                    ['external_id' => $guid],
                    [
                        'name' => $name,
                        'handle' => Str::slug($name.'a', '-')
                    ]
                );
                $collection = Collection::updateOrCreate(
                    ['external_id' => $guid],
                    [
                        'attribute_data' => [
                            'name' => new \Lunar\FieldTypes\Text($name.'a'),
                        ],
                        'collection_group_id' => $collectionGroup->id,
                    ]
                );
            }

            if ($parent){
                $parent->appendNode($collection);
            }
            $index[$guid] = $collection->id;

            // рекурсия для под-групп
            if ($groupXml->Группы->Группа ?? false) {
                $this->importGroups($groupXml->Группы->Группа, $collection->id, $index);
            }
        }
    }
    private function importProduct(\SimpleXMLElement $itemXml, array $groupIndex): void
    {
        /* ---------- 1. Базовые данные из XML ---------- */
        $guid        = (string) $itemXml->Ид;
        $sku         = trim((string) $itemXml->Артикул) ?: $guid;
        $name        = (string) $itemXml->Наименование;
        $description = (string) ($itemXml->Описание ?? '');

        /* ---------- 2. Продукт ---------- */
        /** @var Product $product */
        $product = Product::updateOrCreate(
            ['external_id' => $guid],
            [
                'product_type_id' => 1,     // <-— свой тип «Товары из 1С»
                'status'          => 'published',
                'brand_id'        => 1,     // можно подменить на real brand
                'external_id'        => $guid,     // можно подменить на real brand
                'attribute_data'  => collect([
                    'name' => new TranslatedText(collect([
                        'en' => new Text($name),
                    ])),
                    'description' => new Text($description),
                ]),
            ]
        );
        info(1);
        info($product);
        /* ---------- 3. Вариант (без вариантов Lunar не живёт) ---------- */
        /** @var ProductVariant $variant */
        $variant = $product->variants()->firstOrCreate(
            ['sku' => $sku],
            [
                'tax_class_id' => 1,   // «Без НДС» или нужный класс налогов
                'stock'        => 0,   // потом обновим остатки из offers.xml
            ]
        );

        /* ---------- 4. Цена (если в XML пришла) ---------- */
        if (isset($itemXml->Цены->Цена->ЦенаЗаЕдиницу)) {
            $price = (float) $itemXml->Цены->Цена->ЦенаЗаЕдиницу;
            // Lunar хранит цену в «копейках», поэтому *100 и приводим к int
            Price::updateOrCreate(
                [
                    'priceable_type' => $variant->getMorphClass(),
                    'priceable_id'   => $variant->id,
                    'currency_id'    => 1,          // ID вашей базовой валюты
                    'min_quantity'   => 1,
                ],
                ['price' => (int) round($price * 100)]
            );
        }

        /* ---------- 5. Привязка к коллекциям ---------- */
        $collectionIds = collect($itemXml->Группы->Ид ?? [])
            ->map(fn ($g) => $groupIndex[(string) $g] ?? null)
            ->filter()
            ->all();

        if ($collectionIds) {
            $product->collections()->syncWithoutDetaching($collectionIds);
        }
    }
}
