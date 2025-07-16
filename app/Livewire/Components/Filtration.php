<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Lunar\Models\ProductOption;

class Filtration extends Component
{
    public $productOptions;
    public $minPrice = 0;
    public $maxPrice = 100000000;
    public $selectedOptions = []; // добавляем выбранные опции
    public $isFilterOpen = false; // Состояние для фильтра (открыт/закрыт)

    // Метод для открытия фильтра
    public function openFilter()
    {
        $this->isFilterOpen = true;
    }

    // Метод для закрытия фильтра
    public function closeFilter()
    {
        $this->isFilterOpen = false;
    }
    public function mount()
    {
        $this->productOptions = \App\Models\ProductCharacteristic::all()
            ->groupBy('key')
            ->map(function ($items) {
                return $items->pluck('value')->unique()->values();
            });
    }

    public function applyFilters()
    {
        $this->dispatch('filtersUpdated', [
            'selectedOptions' => $this->selectedOptions,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
        ]);
    }

    public function render()
    {
        return view('livewire.components.filtration');
    }
}
