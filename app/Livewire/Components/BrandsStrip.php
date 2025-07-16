<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Lunar\Models\Brand;

class BrandsStrip extends Component
{
    public function render()
    {

        $brands = Brand::with('thumbnail')
            ->orderBy('name')
            ->take(7)
            ->get();

        return view('livewire.components.brands-strip', [
            'brands' => $this->brands,
        ]);
    }


    public function selectBrand(int $brandId): void
    {
        $this->dispatch('brand-selected', id: $brandId);
    }
}
