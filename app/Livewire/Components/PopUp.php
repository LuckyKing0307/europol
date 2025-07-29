<?php

namespace App\Livewire\Components;

use App\Http\Controllers\AmoController;
use Livewire\Component;

class PopUp extends Component
{
    public $q1, $q2, $q3, $phone, $name;

    public function submitData()
    {
        $message = "
Ответ 1 - {$this->q1}
Ответ 2 - {$this->q2}
Ответ 3 - {$this->q3}
        ";
        (new AmoController())->addContact($this->name, $this->phone, $message);

        $this->reset(['q1', 'q2', 'q3', 'phone', 'name']);

        $this->dispatch('popup-submitted');
    }

    public function render()
    {
        return view('livewire.components.pop-up');
    }
}
