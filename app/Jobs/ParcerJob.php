<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\Price;
use Lunar\Models\Product;

class ParcerJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $path){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $json = file_get_contents($this->path);
        $data = json_decode($json, true);
        $rows = $data['rows'];
        foreach ($rows as $row){
            $product = Product::where('external_id', $row['code'])->first();
            if (!$product) {
                $product = Product::create([
                    'external_id' => $row['code'],
                    'status' => 'draft',
                    'product_type_id' => 1,
                    'attribute_data' => collect([
                        'name' => new TranslatedText(collect([
                            'en' => new Text($row['name']),
                        ])),
                    ]),
                ]);
            }
            $variant = $product->variants()->firstOrCreate(
                ['sku' => $row['code']],
                [
                    'tax_class_id' => 1,
                    'stock' => $row['stock'],
                ]
            );

            $price = Price::updateOrCreate(
                ['priceable_id' => $variant->id],
                [
                    'price' => $row['salePrice'],
                    'compare_price' => 0,
                    'customer_group_id' => 1,
                    'currency_id' => 1,
                    'priceable_type' => 'product_variant'
                ]
            );
        }
        unlink($this->path);
    }
}
