<?php

namespace App\Console\Commands;

use App\Jobs\ImportCatalogJob;
use App\Jobs\ImportImagesJob;
use App\Jobs\ImportOffersJob;
use App\Jobs\ImportProductsFromExcel;
use App\Models\ExcelImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Lunar\Models\Price;
use Lunar\Models\Product;

class TestAupload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-aupload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::where('created_at', '<', now()->subDays(2))->get();
        if (!$products->isEmpty()) {
            foreach ($products as $product) {
                $variant = $product->variants()->first();
                if ($variant){
                    Price::updateOrCreate(
                        ['priceable_id' => $variant->id],
                        [
                            'price' => 0,
                            'compare_price' => 0,
                            'customer_group_id' => 1,
                            'currency_id' => 1,
                            'priceable_type' => 'product_variant'
                        ]
                    );
                }
            }
        }
    }
}
