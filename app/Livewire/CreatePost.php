<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public string $author = 'ads';

    public function render()
    {
        return view('livewire.create-post');
    }
}
