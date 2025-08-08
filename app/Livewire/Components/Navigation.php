<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection;

class Navigation extends Component
{
    /**
     * The search term for the search input.
     *
     * @var string
     */
    public $term = null;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * Return the collections in a tree.
     */
    public function getCollectionsProperty()
    {
        $cacheKey = 'collections';
        return Cache::remember($cacheKey, now()->addDay(), function () {
            Collection::with(['defaultUrl'])->whereNull('parent_id')->get()->map(function ($collection) {
                $collection->brands = $collection->getBrands(); // добавляем свойство brands
                return $collection;
            });
        });
    }

    public function render(): View
    {
        return view('livewire.components.navigation');
    }
}
