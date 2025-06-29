<?php

namespace App\Jobs;

use App\Imports\ProductSheetsImport;
use App\Models\ExcelImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductRowsImport;

class ImportProductsFromExcel implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ExcelImport $import) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->import->mark('processing');

        try {
            Excel::import(new ProductRowsImport, Storage::path('public/'.$this->import->path));
        } catch (\Throwable $e) {
            $this->import->mark('failed', ['error' => $e->getMessage()]);
        }
    }
}
