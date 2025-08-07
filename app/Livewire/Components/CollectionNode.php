<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Lunar\Models\Collection;

class CollectionNode extends Component
{
    public $node;
    public int $level = 0;

    public function render()
    {
        return view('livewire.components.collection-node');
    }
}
