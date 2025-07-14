<?php

namespace App\Livewire;

use App\Http\Controllers\AmoController;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Facades\Payments;
use Lunar\Facades\ShippingManifest;
use Lunar\Models\Cart;
use Lunar\Models\CartAddress;
use Lunar\Models\Country;

class CheckoutPage extends Component
{
    public ?Cart $cart;
    public ?CartAddress $shipping = null;

    public int $currentStep = 1;
    public bool $shippingIsBilling = true;
    public $chosenShipping = null;

    public array $steps = [
        'shipping_address' => 1,
    ];

    public string $paymentType = 'cash-in-hand';
    public array $rules = [];

    public $payment_intent = null;
    public $payment_intent_client_secret = null;

    protected $queryString = [
        'payment_intent',
        'payment_intent_client_secret',
    ];

    protected $listeners = [
        'cartUpdated' => 'refreshCart',
        'selectedShippingOption' => 'refreshCart',
    ];

    public function mount(): void
    {
        if (! $this->cart = CartSession::current()) {
            $this->redirect('/');
            return;
        }

        $this->shipping = $this->cart->shippingAddress ?: new CartAddress;
        $this->shipping->country_id = Country::where('iso3', 'UZB')->value('id');

        $this->rules = array_merge(
            $this->getAddressValidation('shipping'),
            [
                'shippingIsBilling' => 'boolean',
                'chosenShipping' => 'required',
            ]
        );

        $this->determineCheckoutStep();
    }

    public function hydrate(): void
    {
        $this->cart = CartSession::current();
    }

    public function determineCheckoutStep(): void
    {
        $shippingAddress = $this->cart->shippingAddress;

        if ($shippingAddress && $shippingAddress->id) {
            $this->currentStep = $this->steps['shipping_address'] + 1;

            if ($this->shippingOption) {
                $this->chosenShipping = $this->shippingOption->getIdentifier();
                $this->currentStep = $this->steps['shipping_address'] + 2;
            } else {
                $this->chosenShipping = $this->shippingOptions->first()?->getIdentifier();
                return;
            }
        }
    }

    public function refreshCart(): void
    {
        $this->cart = CartSession::current();
    }

    public function getShippingOptionProperty()
    {
        $shippingAddress = $this->cart->shippingAddress;

        if (! $shippingAddress) {
            return null;
        }

        if ($option = $shippingAddress->shipping_option) {
            return ShippingManifest::getOptions($this->cart)->first(fn ($opt) => $opt->getIdentifier() == $option);
        }

        return null;
    }

    public function getShippingOptionsProperty(): Collection
    {
        return ShippingManifest::getOptions($this->cart);
    }

    public function getCountriesProperty(): Collection
    {
        return Country::whereIn('iso3', ['UZB'])->get();
    }

    public function saveAddress(string $type): void
    {
        // Валидация только нужных для формы полей
        $validatedData = $this->validate([
            "{$type}.first_name" => 'required',
            "{$type}.last_name" => 'nullable',
            "{$type}.contact_phone" => 'nullable',
        ]);

        $address = $this->{$type};

        // 🛠 Жестко задаём обязательные поля для CartAddress
        $address->country_id = Country::where('iso3', 'UZB')->value('id');
        $address->line_one = 'ул. Автоматическая, 123';
        $address->city = 'Ташкент';
        $address->postcode = '100000';

        $this->cart->setShippingAddress($address);

        // Дублируем в billing
        $this->cart->setBillingAddress($address->only($address->getFillable()));

        $this->shipping = $this->cart->shippingAddress;

        $this->determineCheckoutStep();
    }

    public function saveShippingOption(): void
    {
        $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenShipping);

        CartSession::setShippingOption($option);

        $this->refreshCart();
        $this->determineCheckoutStep();
    }

    public function checkout()
    {
        // Защита от отсутствия billing
        if (!$this->cart->billingAddress) {
            $billingData = $this->shipping->only($this->shipping->getFillable());
            $this->cart->setBillingAddress($billingData);
        }

        $payment = Payments::cart($this->cart)->withData([
            'payment_intent_client_secret' => $this->payment_intent_client_secret,
            'payment_intent' => $this->payment_intent,
        ])->authorize();

        if ($payment->success) {
            $lines = $this->cart->lines->map(function($line) {
                return "{$line->quantity}× «{$line->purchasable->getDescription()}» — {$line->subTotal->formatted()}";
            })->implode("\n");

            $shipping = $this->cart->shippingAddress;

            $amo = new AmoController();
            $amo->createLead('Заказ с сайта от - ' . $shipping->first_name, $this->cart->total->value);

            return redirect()->route('checkout-success.view');
        }

        return redirect()->route('checkout-success.view');
    }

    protected function getAddressValidation(string $type): array
    {
        return [
            "{$type}.first_name" => 'required',
            "{$type}.last_name" => 'required',
            "{$type}.contact_phone" => 'nullable',
        ];
    }

    public function render(): View
    {
        return view('livewire.checkout-page')->layout('layouts.checkout');
    }
}
