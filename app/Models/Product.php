<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lunar\Models\Product as LunarProduct;

class Product extends LunarProduct
{

    public function characteristics(): HasMany
    {
        return $this->hasMany(ProductCharacteristic::class);
    }
}
