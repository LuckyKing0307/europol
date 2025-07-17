<?php

namespace App\Livewire;

use App\Http\Controllers\AmoController;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $phone = '';
    public $email = '';
    public $message = '';

    protected function rules(): array
    {
        return [
            'name'    => 'required|min:2',
            'phone'   => 'nullable|regex:/^[0-9\s\+\-\(\)]+$/',
            'message' => 'nullable|min:3',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $enquiry = Enquiry::create($this->only(['name', 'phone', 'message']));

        (new AmoController())->addContact($enquiry->name,$enquiry->phone,$enquiry->message);
        $this->reset(['name', 'phone', 'message']);
        $this->dispatch('enquiry-sent');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

