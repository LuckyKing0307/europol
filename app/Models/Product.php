<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Lunar\Models\Product as LunarProduct;
use Illuminate\Database\Eloquent\Builder;

class Product extends LunarProduct
{
    use Searchable;

    public function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query;
    }


    public function getScoutKey(): mixed
    {
        return $this->getKey(); // или $this->id
    }
    public function characteristics(): HasMany
    {
        return $this->hasMany(ProductCharacteristic::class);
    }
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->translateAttribute('name'), // или $this->name если уже в текущей локали
            'description' => $this->translateAttribute('description'),
            // любые другие нужные поля
        ];
    }
}
