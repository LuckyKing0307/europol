<?php

namespace App\Livewire;

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
            'email'   => 'nullable|email',
            'message' => 'nullable|min:3',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $enquiry = Enquiry::create($this->only(['name', 'phone', 'email', 'message']));

        // (необязательно) отсылка уведомления на почту администратора
//        Mail::raw(
//            "Новая заявка #{$enquiry->id}\nИмя: {$enquiry->name}\nТелефон: {$enquiry->phone}\nE-mail: {$enquiry->email}\nСообщение:\n{$enquiry->message}",
//            fn ($msg) => $msg
//                ->to('admin@example.com')   // ←
//                ->subject('Новая заявка с сайта')
//        );

        $this->reset(['name', 'phone', 'email', 'message']);
        $this->dispatch('enquiry-sent');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

