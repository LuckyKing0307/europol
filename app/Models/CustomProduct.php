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

    use Searchable;
    public function getScoutKey(): mixed
    {
        return $this->getKey(); // или $this->id
    }
    public function getScoutKeyName(): mixed
    {
        return 'id'; // или что ты используешь как primary key
    }
    public function characteristics($limiy = null): HasMany
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
