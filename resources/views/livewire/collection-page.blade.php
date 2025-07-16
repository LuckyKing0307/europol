@section('title', $this->collection ? $this->collection->translateAttribute('name') : 'Europol | Ламинат Паркет Ковролин')
<section>
    @livewire('catalog-novigation')
    @livewire('components.filtration')
    @if (!empty($this->activeFilters))
        <div class="mb-6 flex flex-wrap items-center gap-2">
            @foreach ($this->activeFilters as $filterId)
                <div class="px-3 py-1 bg-gray-200 rounded-full text-sm">
                    ID: {{ $filterId }}
                </div>
            @endforeach
        </div>
    @endif
    @if ($this->collection)
    <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>

        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($this->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>
    </div>
    <div class="mt-8">
        {{ $this->products ->links('components.pagination') }}
    </div>
    @else
    <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{__('products.all')}}
        </h1>
        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($this->collections as $product)
                    <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
    <div class="mt-8">
        {{ $this->collections->links('components.pagination') }}
    </div>
    @endif

    <div class="mx-auto max-w-screen-2xl content_block">
{{--        <div class="block_content">--}}
{{--            <div class="sm:w-full lg:w-1/2 flex justify-center">--}}
{{--                <div class="w-full max-w-md hidden_type">--}}
{{--                    <!-- Обёртка Swiper -->--}}
{{--                    <div class="swiper brand-slider">--}}
{{--                        <div class="swiper-wrapper">--}}
{{--                            <div class="brand_wrapper">--}}
{{--                                <img src="" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="swiper-scrollbar mt-4"></div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @livewire('components.brands-strip')
    </div>
</section>
