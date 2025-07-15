<?php

namespace App\Livewire\Components;

use Livewire\Component;

class LikeButton extends Component
{
    public $productId;
    public $liked = false;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->liked = in_array($productId, session()->get('liked_products', []));
    }

    public function toggleLike()
    {
        $likedProducts = session()->get('liked_products', []);

        if (in_array($this->productId, $likedProducts)) {
            $likedProducts = array_diff($likedProducts, [$this->productId]);
            $this->liked = false;
        } else {
            $likedProducts[] = $this->productId;
            $this->liked = true;
        }

        session()->put('liked_products', $likedProducts);
    }

    public function render()
    {
        return view('livewire.components.like-button');
    }
}
