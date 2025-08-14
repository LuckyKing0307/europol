<?php

namespace App\Livewire;

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
        return Collection::with(['defaultUrl'])->get();
    }
}
