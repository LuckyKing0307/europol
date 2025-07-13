<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ProductSheetsImport implements WithMultipleSheets
{
    protected array $firstRows = [];
    public function __construct(string $filePath)
    {
        // Получаем имена листов
        $sheets = (new \PhpOffice\PhpSpreadsheet\Reader\Xlsx)->listWorksheetNames($filePath);

        foreach ($sheets as $sheetIndex => $sheetName) {
            // Читаем первую строку с каждого листа
            $rows = Excel::toCollection(new class implements \Maatwebsite\Excel\Concerns\ToModel {
                public $rows;

                public function model($row)
                {
                    $this->rows = $row;
                }
            }, $filePath, null, \Maatwebsite\Excel\Excel::XLSX, [
                'worksheetName' => $sheetName,
            ]);

            $this->firstRows[$sheetName] = $rows[0][0] ?? [];
        }
    }
    /**
    * @param Collection $collection
    */
    public function sheets(): array
    {
        $result = [];
        foreach ($this->firstRows as $sheetName => $firstRow) {
            $result[$sheetName] = new ProductRowsImport($sheetName, $this->firstRows[$sheetName]->toArray());
        }

        return $result;
    }
}
