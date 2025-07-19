<?php

namespace App\Jobs;

use App\Models\ImportImages;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Lunar\Models\Product;
use ZipArchive;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public string $extractDir;
    public function __construct(
        public string        $zipPath,
        public ?ImportImages $logRow = null,
    )
    {
        $this->extractDir = 'tmp/img-import-' . uniqid();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->updateStatus('processing');
        try {
            $this->unzip();
            $this->processFolders();
            $this->updateStatus('done');
        } catch (\Throwable $e) {
            $this->updateStatus('failed', $e->getMessage());
            throw $e;
        } finally {
            Storage::deleteDirectory($this->extractDir);
        }
    }

    protected function unzip(): void
    {
        $archive = new ZipArchive;
        $fullZip = Storage::path($this->zipPath);
        info($fullZip);
        if ($archive->open($fullZip) === true) {
            info('ok');
            $archive->extractTo(Storage::path($this->extractDir));
            $archive->close();
        } else {
            throw new \RuntimeException("Не удалось открыть {$fullZip}");
        }
    }

    protected function processFolders(): void
    {
        $root = Storage::path($this->extractDir).'/photos';
        $dirs = scandir($root);
        info($dirs);
        foreach ($dirs as $dir) {
            if (!ctype_digit($dir)) {
                continue; // пропускаем системные папки/файлы
            }

            $product = Product::where('external_id', $dir);
            if (!$product->exists()) {
                Log::warning("Импорт картинок: товар {$dir} не найден");
                continue;
            }

            $files = glob($root . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . '*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE);

            if (empty($files)) {
                Log::info("У товара {$dir} нет файлов в архиве");
                continue;
            }
            $product->first()->clearMediaCollection('images');
            foreach ($files as $index => $file) {
                $product->first()
                    ->addMedia($file)
                    ->toMediaCollection('images');
            }

            Log::info("К товару {$dir} добавлено " . count($files) . ' фото');
        }
    }


    protected function updateStatus(string $status, string $log = ''): void
    {
        if ($this->logRow) {
            $this->logRow->update([
                'status' => $status,
                'log' => $log,
            ]);
        }
    }
}
