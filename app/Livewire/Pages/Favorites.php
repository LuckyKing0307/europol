<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use App\Services\FacebookConversionService;
use Livewire\Component;

class Favorites extends Component
{
    public $products = [];

    public function mount()
    {
        $likedIds = session()->get('liked_products', []);
        $this->products = Product::whereIn('id', $likedIds)->get();
    }

    public function render()
    {
        $fb = new FacebookConversionService();
        $fb->sendEvent([
            'event_name' => 'ViewContent',
            'event_time' => time(),
            'action_source' => 'website',
            'user_data' => [
                'client_ip_address' => request()->ip(),
                'client_user_agent' => request()->userAgent(),
            ],
            'custom_data' => [
                'content_type' => 'favorites',
            ],
        ]);
        return view('livewire.pages.favorites', [
            'products' => $this->products,
        ]);
    }
}
