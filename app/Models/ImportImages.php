<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportImages extends Model
{
    protected $fillable = ['zip_path', 'status', 'processed', 'log'];
}
