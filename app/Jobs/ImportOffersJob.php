<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Lunar\Models\Price;

class ImportOffersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** Путь к xml-файлу с предложениями */
    public string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /** Основная логика */
    public function handle(): void
    {
        $xml = simplexml_load_file($this->filePath);

        foreach ($xml->ПакетПредложений->Предложения as $offer) {
            $offered = $offer->Предложение;
            $externalId = (string) $offered->Ид;
            $qty        = (float) ($offered->Предложение->Количество ?? 0);

            $product = Product::where('external_id', $externalId);
            if (!$product->exists()) {
                Log::warning("Offers: товар c external_id={$externalId} не найден");
                continue;   // каталога ещё нет — пропускаем
            }
            $product = $product->first();
            /** @var ProductVariant $variant */
            $variant = $product->variants()->firstOrCreate(
                ['sku' => $product->external_id],     // запасной вариант
                ['tax_class_id' => 1, 'stock' => 0]
            );

            if (isset($offered->Цены->Цена->ЦенаЗаЕдиницу)) {
                $rawPrice  = (float) $offered->Цены->Цена->ЦенаЗаЕдиницу;

                Price::updateOrCreate(
                    [
                        'priceable_type' => $variant->getMorphClass(),
                        'priceable_id'   => $variant->id,
                        'currency_id'    => 1,
                        'min_quantity'   => 1,
                    ],
                    ['price' => (int) round($rawPrice * 100)]
                );
            }

            /* ---- 2. остаток ---- */
            $variant->stock = (int) round($qty);
            $variant->save();
        }
    }
}
