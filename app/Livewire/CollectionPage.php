<?php

namespace App\Livewire;

use App\Models\Product;
use App\Traits\FetchesUrls;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection as CollectionModel;

class CollectionPage extends Component
{
    use FetchesUrls,WithPagination;

    public array $activeFilters = [];
    public ?int $minPrice = null;
    public ?int $maxPrice = null;

    public function mount(?string $slug=null): void
    {
        if ($slug) {
            $this->url = $this->fetchUrl(
                $slug,
                (new CollectionModel)->getMorphClass(),
                [
                    'element.thumbnail',
                    'element.products.variants.basePrices',
                    'element.products.variants.productOptionValues.option',
                    'element.products.defaultUrl',
                ]
            );

            if (!$this->url) {
                abort(404);
            }
        }
    }

    /**
     * Computed property to return the collection.
     */
    public function getCollectionProperty(): mixed
    {
        return $this->url?->element;
    }
    #[On('filtersUpdated')]
    public function filtersUpdated($filters)
    {
        $this->activeFilters = $filters['selectedOptions'] ?? [];
        $this->minPrice = $filters['minPrice'] ?? null;
        $this->maxPrice = $filters['maxPrice'] ?? null;

        $this->resetPage(); // сбрасываем пагинацию
    }
    public function getActiveFiltersProperty()
    {
        return $this->activeFilters;
    }
    /**
     * Computed property to return the collection.
     */
    public function getProductsProperty(): mixed
    {
        $childIds = $this->url?->element->children()->pluck('id')->all();
        if (count($childIds)>0){

            $query = Product::query()
                ->whereExists(function ($q) use ($childIds) {
                    $q->select(DB::raw(1))
                        ->from('lunar_collection_product as cp')
                        ->whereColumn('cp.product_id', 'lunar_products.id')
                        ->whereIn('cp.collection_id', $childIds);
                });
        }else{
            $query = $this->url?->element->products();
        }
        if (!empty($this->activeFilters)) {
            $query->whereHas('variants.productOptionValues', function ($q) {
                $q->whereIn('lunar_product_option_values.id', $this->activeFilters);
            });
        }
        if (!is_null($this->minPrice)) {
            $query->whereHas('variants.basePrices', function ($q) {
                $q->where('price', '>=', $this->minPrice);
            });
        }

        if (!is_null($this->maxPrice)) {
            $query->whereHas('variants.basePrices', function ($q) {
                $q->where('price', '<=', $this->maxPrice);
            });
        }
        return $query->paginate(16);
    }
    public function getCollectionsProperty()
    {
         $query = Product::with([
            'variants.basePrices',
            'variants.productOptionValues.option',
            'defaultUrl',
            'thumbnail',
        ]);
        if (!is_null($this->minPrice)) {
            $query->whereHas('variants.basePrices', function ($q) {
                $q->where('price', '>=', $this->minPrice);
            });
        }

        if (!is_null($this->maxPrice)) {
            $query->whereHas('variants.basePrices', function ($q) {
                $q->where('price', '<=', $this->maxPrice);
            });
        }
        if (!empty($this->activeFilters)) {
            $query->whereHas('variants.productOptionValues', function ($q) {
                $q->whereIn('lunar_product_option_values.id', $this->activeFilters);
            });
        }

        return $query->paginate(16);
    }

    public function render(): View
    {
        return view('livewire.collection-page');
    }
}
