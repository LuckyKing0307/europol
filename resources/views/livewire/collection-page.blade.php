@section('title', $this->collection ? $this->collection->translateAttribute('name') : 'Europol | Ламинат Паркет Ковролин')
<section>
    @livewire('catalog-novigation')
    @livewire('components.filtration')
    @if ($this->collection)
    <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>

        <div class="grid collection-grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($this->products as $product)
                <x-product-card :product="$product" :rate="$this->rate"/>
            @empty
            @endforelse
        </div>

    </div>
    <div class="mt-8" wire:key="page-{{$this->products->currentPage()}}">
        {{ $this->products->links('components.pagination') }}
    </div>
    @else
    <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{__('products.all')}}
        </h1>
        <div class="grid collection-grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
            {{$this->rate}}
            @foreach($this->collections as $product)
                    <x-product-card :product="$product" :rate="$this->rate"/>
            @endforeach
        </div>
    </div>
    <div class="mt-8" wire:key="page-{{$this->collections->currentPage()}}">
        {{ $this->collections->links('components.pagination') }}
    </div>
    @endif

    <div class="mx-auto max-w-screen-2xl content_block" wire:key="brands-strip">
        <livewire:components.brands-strip />
    </div>
</section>

@push('scripts')
    <script defer>
        document.addEventListener('livewire:load', () => {
            // Прокрутка к началу страницы
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        function openCart(e){
            document.querySelector('.'+e).style.display = 'flex';
        }
        function closeFilter(e){
            document.querySelector('.'+e).style.display = 'none';
        }
    </script>
@endpush
