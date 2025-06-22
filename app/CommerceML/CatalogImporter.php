<?php

namespace App\CommerceML;

use App\Jobs\ImportCatalogJob;
use App\Jobs\ImportOffersJob;
use Illuminate\Support\Str;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Mavsan\LaProtocol\Interfaces\Import;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Lunar\Models\Collection;
use Lunar\Models\Product;

class CatalogImporter implements Import
{
    public function import($fileName): string
    {
        ImportCatalogJob::dispatch($fileName);
        $type = $this->detectFileType($fileName);
        if($type=='offers'){
            ImportOffersJob::dispatch($fileName);
        }elseif ($type=='import'){
            ImportCatalogJob::dispatch($fileName);
        }
        return self::answerSuccess;
    }

    public function getAnswerDetail(): string
    {
        return 'test';
    }
    private function detectFileType(string $path): string
    {
        // 1) По имени (быстрее всего)
        $base = Str::lower(basename($path));

        if (Str::contains($base, ['offers'])) {
            return 'offers';
        }
        if (Str::contains($base, ['import'])) {
            return 'import';
        }

        return 'unknown';
    }
}
