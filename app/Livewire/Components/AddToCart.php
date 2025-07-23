<?php

namespace App\Livewire\Components;

use App\Services\FacebookConversionService;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Base\Purchasable;
use Lunar\Facades\CartSession;

class AddToCart extends Component
{
    /**
     * The purchasable model we want to add to the cart.
     */
    public ?Purchasable $purchasable = null;
    /**
     * The quantity to add to cart.
     */
    public float $quantity = 1;
    public float $qty_float = 1.76;

    public int $productId;

    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|min:1|max:10000',
        ];
    }
    public function mount()
    {
        $this->productId = $this->purchasable->id; // Получаем ID продукта
    }

    public function increment()
    {
        $this->qty_float = $this->qty_float+1.73;
        $this->quantity = $this->quantity+1;
    }

    public function decrement()
    {
        if ($this->quantity > 0.5) {
            $this->qty_float = $this->qty_float-1.73;
            $this->quantity = $this->quantity-1;
        }
    }
    public function addToCart(): void
    {
        $fb = new FacebookConversionService();
        $this->validate();

        if ($this->purchasable->stock < $this->quantity) {
            $this->addError('quantity', 'Извините, запрашиваемое количество товара недоступно в данный момент.');

            return;
        }

        CartSession::manager()->add($this->purchasable, $this->quantity);
        $this->dispatch('add-to-cart');

        $fb->sendEvent([
            'event_name' => 'AddToCart',
            'event_time' => time(),
            'action_source' => 'website',
            'user_data' => [
                'client_ip_address' => request()->ip(),
                'client_user_agent' => request()->userAgent(),
            ],
        ]);
    }

    public function render(): View
    {
        return view('livewire.components.add-to-cart');
    }
}
