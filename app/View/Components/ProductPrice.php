<?php

namespace App\View\Components;

use Exception;
use Illuminate\View\Component;
use Illuminate\View\View;
use Lunar\Facades\Pricing;
use Lunar\Models\Price;
use Lunar\Models\ProductVariant;

class ProductPrice extends Component
{
    public ?Price $price = null;
    public $rate = 0;

    public ?ProductVariant $variant = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product = null, $variant = null, $rate = 1)
    {
        $this->rate = $rate;
        try {
            $this->price = Pricing::for(
                $variant ?: $product->variants->first()
            )->get()->matched;
        } catch (\Lunar\Exceptions\MissingCurrencyPriceException $e) {
            $this->price = null;
            // или какая-то дефолтная цена
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.product-price');
    }
}
