<?php

namespace App\CommerceML;

use Mavsan\LaProtocol\Interfaces\Import;

class CatalogImporter implements Import
{
    public function import($fileName): string
    {
        info("CML-debug: файл принят, расположен в {$fileName}");
        return self::answerSuccess;   // ничего не разбираем — лишь подтверждаем приём
    }

    public function getAnswerDetail(): string
    {
        return 'test';
    }
}
