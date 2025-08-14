<?php

namespace App\Livewire\Pages;

use App\Models\Project;
use App\Services\FacebookConversionService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Works extends Component
{
    public function render()
    {
        $projects = Project::query()
            ->where('is_active', true)
            ->latest('created_at')->get();
//        $fb = new FacebookConversionService();
//        $fb->sendEvent([
//            'event_name' => 'ViewContent',
//            'event_time' => time(),
//            'action_source' => 'website',
//            'user_data' => [
//                'client_ip_address' => request()->ip(),
//                'client_user_agent' => request()->userAgent(),
//            ],
//            'custom_data' => [
//                'content_type' => 'works',
//            ],
//        ]);
        return view('livewire.pages.works', compact('projects'));
    }
}
