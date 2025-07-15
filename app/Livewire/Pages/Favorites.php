<?php

namespace App\Livewire\Pages;

use App\Models\Product;
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
        return view('livewire.pages.favorites', [
            'products' => $this->products,
        ]);
    }
}
