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
        $cacheKey = 'collections_comp';
        return Cache::remember($cacheKey, now()->addDay(), function () {
            $coll = Collection::with(['defaultUrl'])->whereNull('parent_id')->get();
            return $coll;
        });
    }
}
