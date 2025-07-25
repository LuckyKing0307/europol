<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketTalon extends Model
{
    protected $fillable = [
        'product_name',
        'phone_number',
        'customer_name',
        'bought_date',
        'order_id',
        'warranty_period',
        'warranty_types',
        'some_letter'
    ];

    protected $casts = [
        'warranty_types' => 'array',
    ];
}
