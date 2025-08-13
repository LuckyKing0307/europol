<?php

namespace App\Livewire\Pages;

use App\Models\SeoPage;
use App\Services\FacebookConversionService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Blogs extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';
    public string $category = '';

    public $queryString = ['category', 'search', 'page'];


    public function setCategory($cat)
    {
        $this->resetPage();
        $this->category = $cat;
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
                'content_type' => 'blogs',
            ],
        ]);
        $categories = SeoPage::whereNotNull('category')
            ->pluck('category')
            ->unique()
            ->values();


        $blogs = SeoPage::query()
            ->when($this->category, fn($q) => $q->where('category', $this->category))
            ->when($this->search, fn($q) =>
            $q->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('meta_description', 'like', "%{$this->search}%");
            })
            )
            ->orderByDesc('updated_at')
            ->paginate(6);
        return view('livewire.pages.blogs',[
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }
}
