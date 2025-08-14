<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Lunar\Models\Collection;

class CategoriesComponent extends Component
{
    public function render()
    {
        return view('livewire.categories-component');
    }
    public function getCollectionsProperty()
    {
        $cacheKey = 'brand_collections';
        return Cache::remember($cacheKey, now()->addDay(), function () {
            $coll = Collection::with(['defaultUrl'])->whereNull('parent_id')->get()->map(function ($collection) {
                $collection->img = $collection->getFirstMediaUrl('images'); // добавляем свойство brands
                return $collection;
            });
            return $coll;
        });
    }
}
