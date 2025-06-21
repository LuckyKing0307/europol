<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCharacteristic extends Model
{
    protected $fillable = ['product_id', 'key', 'value'];


}
