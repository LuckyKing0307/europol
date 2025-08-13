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

        $path = public_path('serteficates'); // путь к папке
        $files = collect(\File::files($path))
            ->map(fn($file) => $file->getFilename());

        $path = public_path('warranties'); // путь к папке
        $warranties = collect(\File::files($path))
            ->map(fn($file) => $file->getFilename());

        return view('livewire.pages.warranty', compact('files', 'warranties'));
    }
}
