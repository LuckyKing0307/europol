<?php

namespace App\Livewire\Pages;

use App\Services\FacebookConversionService;
use Livewire\Component;

class Warranty extends Component
{
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
                'content_type' => 'warranty',
            ],
        ]);
        return view('livewire.pages.warranty');
    }
}
