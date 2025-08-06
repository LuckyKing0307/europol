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
        $this->addNewProducts('https://api.moysklad.ru/api/remap/1.2/report/stock/all');

    }

    function addNewProducts($link)
    {
        $login = env('MOY_SKLAD_LOGIN');
        $password = env('MOY_SKLAD_PASSWORD');
        $client = new \GuzzleHttp\Client();
        $response = $client->get($link, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($login.':'.$password),
                'Content-Type' => 'application/json;charset=utf-8',
                'Accept-Encoding' => 'gzip'
            ],
        ]);
        // Удаляем связанные данные
        $data = json_decode($response->getBody(), true);
        $filename = 'moysklad_' . uniqid() . '.json';
        $path = storage_path('app/moysklad/' . $filename);
        // Убедимся, что директория существует
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        // Сохраняем данные
        file_put_contents($path, json_encode($data));
        ParcerJob::dispatch($path);
    }
}
