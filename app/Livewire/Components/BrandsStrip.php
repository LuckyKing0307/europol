<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Lunar\Models\Brand;

class BrandsStrip extends Component
{
    public function getBrandsProperty()
    {
        // Можно заменить orderBy() на random() при желании
        return Brand::with('thumbnail')
            ->orderBy('name')
            ->take(7)
            ->get();
    }

    public function render()
    {
        return view('livewire.components.brands-strip', [
            'brands' => $this->brands,
        ]);
    }


    public function selectBrand(int $brandId): void
    {
        $this->dispatch('brand-selected', id: $brandId);
    }
}
