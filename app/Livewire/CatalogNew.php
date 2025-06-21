<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Lunar\Facades\Pricing;

class CatalogNew extends Component
{
    public $productsData = [];
    public function mount()
    {
        $products = Product::orderBy('created_at','desc')->limit(20)->get();
        foreach ($products as $product) {
            $variant = $product->variants->first();
            $pricing = $variant ? Pricing::for($variant)->get() : null;
            $basePrice = $pricing->base->price->value ?? 0;
            $currency = $pricing->base->currency->code ?? 'USD';
            $this->productsData[] = [
                'name' => $product->translateAttribute('name'),
                'base_price' => number_format($basePrice / 100, 2),
                'currency' => $currency,
                'url' => $product->defaultUrl->slug,
                'img' => $product->thumbnail,
            ];
        }
        $this->dispatch('swiper-new');
    }
    public function render()
    {
        return view('livewire.catalog-new');
    }
}
