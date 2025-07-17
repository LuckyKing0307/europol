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
    /**
     * Return the sale collection.
     */
    public $currentSlide = 0;
    public $slides = 0;

    public $carouselItems;

    public function getSaleCollectionProperty(): Collection | null
    {
        $this->slides = Url::whereElementType((new Collection)->getMorphClass())->whereSlug('sale')->count();
        return Url::whereElementType((new Collection)->getMorphClass())->whereSlug('sale')->first()?->element ?? null;
    }
    public function getCurrentSlideProperty()
    {
        return $this->currentSlide;
    }

    /**
     * Return all images in sale collection.
     */
    public function getSaleCollectionImagesProperty()
    {
        if (! $this->getSaleCollectionProperty()) {
            return null;
        }

        $collectionProducts = $this->getSaleCollectionProperty()
            ->products()->inRandomOrder()->limit(4)->get();

        $saleImages = $collectionProducts->map(function ($product) {
            return $product->thumbnail;
        });

        return $saleImages->chunk(2);
    }

    public function getCarouselItems()
    {
        return CarouselItem::orderBy('sort_order')->get();
    }


    public function next()
    {
        $this->currentSlide = ($this->currentSlide + 1) % $this->slides;
    }

    public function prev()
    {
        $this->currentSlide = ($this->currentSlide - 1 + $this->slides) % $this->slides;
    }
    /**
     * Return a random collection.
     */
    public function getRandomCollectionProperty(): ?Collection
    {
        $collections = Url::whereElementType((new Collection)->getMorphClass());

        if ($this->getSaleCollectionProperty()) {
            $collections = $collections->where('element_id', '!=', $this->getSaleCollectionProperty()?->id);
        }

        return $collections->inRandomOrder()->first()?->element;
    }
    /**
     * Return a random collection.
     */


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
