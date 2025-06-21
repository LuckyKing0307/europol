<?php

namespace App\Livewire;

use Livewire\Component;

class Popular extends Component
{

    public function mount()
    {
        $this->dispatch('swiper-popular');
    }
    public function popular()
    {
        return \App\Models\Popular::limit(6)->get();
    }
    public function render()
    {
        $popular  = $this->popular();
        return view('livewire.popular',compact('popular'));
    }
}
