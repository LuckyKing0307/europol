<?php

namespace App\Imports;

use App\Models\ProductCharacteristic;
use Illuminate\Support\Str;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\Brand;
use Lunar\Models\Collection;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductRowsImport implements ToModel, WithChunkReading, ShouldQueue, WithStartRow, WithBatchInserts
{
    use RemembersRowNumber, Importable;

    public function __construct(protected ?string $defaultCategory = null)
    {
    }

    public function model(array $row)
    {
        if($row[0]!=''){

            $name = $row[0];
            $collection_father = Collection::whereRaw(
                "JSON_UNQUOTE(JSON_EXTRACT(attribute_data, '$.name.value')) = ?",
                [$name]
            )->first();
            if (!$collection_father) {
                $collectionGroup = \Lunar\Models\CollectionGroup::updateOrCreate(
                    [
                        'name' => $name,
                        'handle' => Str::slug($name, '_').'321'
                    ]
                );
                $collection_father = Collection::updateOrCreate(
                    [
                        'attribute_data' => [
                            'name' => new \Lunar\FieldTypes\Text($name),
                        ],
                        'collection_group_id' => $collectionGroup->id,
                    ]
                );
            }
            $name = $row[2];
            $collection = Collection::whereRaw(
                "JSON_UNQUOTE(JSON_EXTRACT(attribute_data, '$.name.value')) = ?",
                [$name]
            )->first();
            if (!$collection) {
                $collection = Collection::updateOrCreate(
                    [
                        'attribute_data' => [
                            'name' => new \Lunar\FieldTypes\Text($name),
                        ],
                        'collection_group_id' => $collection_father->collection_group_id,
                        'parent_id' => $collection_father->id,
                    ]
                );
            }

            $brand = Brand::firstOrCreate(['name' => $row[2]]);
            $guid = $row[3];
            $sku = $row[3];
            $name = $row[4];
            $description = $row[16];

            $product = Product::updateOrCreate(
                ['external_id' => $guid],
                [
                    'product_type_id' => 1,
                    'status' => 'published',
                    'brand_id' => $brand->id,
                    'attribute_data' => collect([
                        'name' => new TranslatedText(collect([
                            'en' => new Text($name),
                        ])),
                        'description' => new Text($description),
                    ]),
                ]
            );
            $variant = $product->variants()->firstOrCreate(
                ['sku' => $sku],
                [
                    'tax_class_id' => 1,
                    'stock' => 0,
                ]
            );
            $price = Price::updateOrCreate(
                ['priceable_id' => $variant->id],
                [
                    'price' => 0,
                    'compare_price' => 0,
                    'customer_group_id' => 1,
                    'currency_id' => 1,
                    'priceable_type' => 'product_variant'
                ]
            );
            $lists = [
                ['Толщина, мм', $row[5]],
                ['Ширина, мм', $row[6]],
                ['Длина, мм', $row[7]],
                ['Фаска', $row[8]],
                ['Класс износостойкости', $row[9]],
                ['Страна производителя', $row[10]],
                ['Цвет', $row[11]],
                ['Тип соединения', $row[12]],
                ['Пожарные сертификаты', $row[13]],
                ['Срок службы, лет', $row[14]],
                ['В упаковке, шт', $row[15]],
            ];
            foreach ($lists as $list) {
                ProductCharacteristic::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'key' => $list[0],
                    ],
                    [
                        'value' => $list[1],
                    ]
                );
            }
            $product->collections()->syncWithoutDetaching([$collection->id]);
        }
    }

    public function chunkSize(): int
    {
        return 5000;
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function startRow(): int
    {
        return 2;
    }
}
