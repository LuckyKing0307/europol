<?php

namespace App\Console\Commands;

use App\Jobs\ImportCatalogJob;
use App\Jobs\ImportImagesJob;
use App\Jobs\ImportOffersJob;
use App\Jobs\ImportProductsFromExcel;
use App\Jobs\ParcerJob;
use App\Models\ExcelImport;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $products = Product::where(['status' => 'draft'])->whereNotNull('external_id')->get();
        foreach ($products as $product) {
            $product->characteristics()->delete();

            $product->images()->delete();

            foreach ($product->variants as $variant) {
                $variant->prices()->delete();
                $variant->delete();
            }

            $product->delete();
        }
    }
}
