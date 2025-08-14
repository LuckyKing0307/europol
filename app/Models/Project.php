<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'images', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'bool',
        'images'    => 'array', // массив картинок
    ];
}
