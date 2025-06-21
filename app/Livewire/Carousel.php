<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Lunar\Models\Collection;
use Lunar\Models\Url;

class Carousel extends Component
{
    public function getSaleCollectionProperty(): Collection | null
    {
        return Url::whereElementType((new Collection)->getMorphClass())->whereSlug('sale')->first()?->element ?? null;
    }
    public function render()
    {
        return view('livewire.carousel');
    }
}
