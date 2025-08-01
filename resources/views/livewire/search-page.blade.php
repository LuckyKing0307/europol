<section>
    @livewire('catalog-novigation')
    @livewire('components.filtration')
    <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ __('search.result') }}
            @if (isset($term))
                Для <u style="color: white;">{{ $term }}</u>
            @endif
        </h1>

        <div class="grid collection-grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($this->results as $result)
                <x-product-card :product="$result" :rate="$this->rate"/>
            @endforeach
        </div>
    </div>
</section>
