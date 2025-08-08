<?php

namespace App\Livewire;

use Livewire\Component;
use Lunar\Models\Collection;

class CatalogNovigation extends Component
{
    /**
     * Return the collections in a tree.
     */
    public function getCollectionsProperty()
    {
        return Collection::with(['defaultUrl'])->whereNull('parent_id')->get();
    }

    public function mount()
    {
        $this->dispatch('swiper-catalogs');
    }

    public function render()
    {
        return view('livewire.catalog-novigation');
    }
}
