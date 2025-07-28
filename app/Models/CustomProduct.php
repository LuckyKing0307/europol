<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Lunar\Models\Product as LunarProduct;

class CustomProduct extends LunarProduct
{
    protected $table = 'products';

    public function characteristics($limiy = null): HasMany
    {
        return $this->hasMany(ProductCharacteristic::class);
    }
}
