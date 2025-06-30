<?php

namespace App\Console\Commands;

use App\Jobs\ImportCatalogJob;
use App\Jobs\ImportImagesJob;
use App\Jobs\ImportOffersJob;
use App\Jobs\ImportProductsFromExcel;
use App\Models\ExcelImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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
        ImportImagesJob::dispatch('imports/photos.zip');
    }
}
