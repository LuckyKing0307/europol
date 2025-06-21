<?php

namespace App\Livewire;

use App\Models\Recommendation;
use Livewire\Component;

class Recomendations extends Component
{
    public function recomendations()
    {
        return Recommendation::limit(4)->get();
    }
    public function render()
    {
        $recommendations  = $this->recomendations();
        return view('livewire.recomendations',compact('recommendations'));
    }
}
