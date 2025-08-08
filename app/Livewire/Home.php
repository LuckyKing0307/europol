<?php

namespace App\Livewire;

use App\Models\CarouselItem;
use App\Models\Product;
use App\Models\Recommendation;
use App\Services\FacebookConversionService;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\Pricing;
use Lunar\Models\Collection;
use Lunar\Models\Url;

class Home extends Component
{
    public function render(): View
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
                'content_type' => 'home',
            ],
        ]);

        return view('livewire.home');
    }
}
