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
use Illuminate\Support\Facades\DB;
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
        // Получаем ID всех продуктов, которые нужно удалить
        $productIds = DB::table('lunar_products')
            ->where('status', 'draft')
            ->whereNotNull('external_id')
            ->pluck('id');

        if ($productIds->isEmpty()) {
            return;
        }

        // Удаляем связанные данные
        DB::table('lunar_collection_product')->whereIn('product_id', $productIds)->delete();
        DB::table('lunar_customer_group_product')->whereIn('product_id', $productIds)->delete();
        DB::table('lunar_product_associations')->whereIn('product_parent_id', $productIds)->delete();
        DB::table('lunar_product_product_option')->whereIn('product_id', $productIds)->delete();
        DB::table('product_characteristics')->whereIn('product_id', $productIds)->delete();

        $variantIds = DB::table('lunar_product_variants')->whereIn('product_id', $productIds)->pluck('id');

        if ($variantIds->isNotEmpty()) {
            DB::table('lunar_prices')->whereIn('priceable_id', $variantIds)->delete();
            DB::table('lunar_product_variants')->whereIn('id', $variantIds)->delete();
        }

        DB::table('lunar_products')->whereIn('id', $productIds)->delete();
    }
}
