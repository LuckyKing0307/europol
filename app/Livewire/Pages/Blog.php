<?php

namespace App\Livewire\Pages;

use App\Models\SeoPage;
use App\Services\FacebookConversionService;
use Livewire\Component;

class Blog extends Component
{
    public SeoPage $page;
    public $relatedPosts;
    public $nextPost;

    public function mount($slug)
    {
        $this->page = SeoPage::where('slug', $slug)->firstOrFail();


        $this->nextPost = SeoPage::where('slug', '!=', $slug)
            ->inRandomOrder()
            ->first();

        $this->relatedPosts = SeoPage::where('slug', '!=', $slug)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

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
                'content_type' => 'blog',
            ],
        ]);
        return view('livewire.pages.blog');
    }
}
