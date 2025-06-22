<?php

namespace App\Console\Commands;

use App\Jobs\ImportCatalogJob;
use App\Jobs\ImportOffersJob;
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
        $exchangeRoot = storage_path('app/1cExchange');
        $subDirs = File::directories($exchangeRoot);
        sort($subDirs);
        $firstDir = $subDirs[0] ?? null;// массив путей
        $importPath = $firstDir . DIRECTORY_SEPARATOR . 'import.xml';
        $offersPath = $firstDir . DIRECTORY_SEPARATOR . 'offers.xml';
        ImportCatalogJob::dispatch($importPath);
        ImportOffersJob::dispatch($offersPath);
    }
}
