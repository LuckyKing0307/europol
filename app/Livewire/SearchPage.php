<?php

namespace App\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Product;

class SearchPage extends Component
{
    use WithPagination;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * The search term.
     */
    public ?string $term = null;

    /**
     * Return the search results.
     */
    public function getResultsProperty(): LengthAwarePaginator
    {
        return Product::search($this->term)->paginate(16);
    }
    public function getRateProperty()
    {
        $response = Http::get('https://cbu.uz/uz/arkhiv-kursov-valyut/json/');

        $usd = collect($response->json())
            ->firstWhere('Ccy', 'USD');

        return (float) $usd['Rate'];
    }
    public function render(): View
    {
        return view('livewire.search-page');
    }
}
