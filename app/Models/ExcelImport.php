<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcelImport extends Model
{
    protected $fillable = [
        'original_name', 'path', 'status',
        'rows_processed', 'error',
    ];

    # Удобный помощник
    public function mark(string $status, array $extra = []): void
    {
        $this->forceFill(array_merge(['status' => $status], $extra))->save();
    }
}
