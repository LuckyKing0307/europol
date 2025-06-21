<?php

namespace App\Livewire;

use Livewire\Component;
use Lunar\Facades\Pricing;
use Lunar\Models\Collection;
use Lunar\Models\CollectionGroup;

class TopSales extends Component
{
    public $productsData = [];

    public function mount()
    {

        $collection = CollectionGroup::where('handle', 'hits')->first();

        foreach ($collection->collections as $coll) {
            $discount = $coll->discounts->first()?->data['percentage'] ?? 0;

            foreach ($coll->products as $product) {
                $variant = $product->variants->first();
                $pricing = $variant ? Pricing::for($variant)->get() : null;

                if ($pricing) {
                    $basePrice = $pricing->base->price->value ?? 0;
                    $currency = $pricing->base->currency->code ?? 'USD';

                    $discountedPrice = $basePrice;

                    if ($discount > 0) {
                        $discountedPrice = $basePrice - ($basePrice * ($discount / 100));
                    }

                    $this->productsData[] = $product;
                }
            }
        }
        $this->dispatch('swiper-initialize');
    }
    public function render()
    {
        return view('livewire.top-sales');
    }
}
