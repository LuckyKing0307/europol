@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush
<section class="favorites">
    @if(count($this->products) == 0)
        <div class="favorites__wrapper  max-w-screen-2xl mx-auto">
            <div class="container" style="display:flex; flex-direction: column; align-items: center;">
                <img src="{{ asset('img/favorites.png') }}" class="favorites__img" alt="избранное" height="220" width="230" />
                <h1 class="favorites__title">Добавьте товары в избранное</h1>
                <a href="{{route('collection.view.all')}}" class="favorites__btn">Перейти в каталог</a>
            </div>
        </div>
    @else
        <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">
                Избранные товары
            </h1>

            <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($this->products as $product)
                    <x-product-card :product="$product" />
                @empty
                @endforelse
            </div>
        </div>
    @endif
</section>
