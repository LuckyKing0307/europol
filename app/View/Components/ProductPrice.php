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

    public ?ProductVariant $variant = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product = null, $variant = null)
    {
        try {
            $var = ProductVariant::where(['product_id' => $product->id])->first();
            $this->price = Price::where(['priceable_id' => $var->id])->first();
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
