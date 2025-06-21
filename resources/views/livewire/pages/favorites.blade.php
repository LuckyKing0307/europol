@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush
<section class="favorites max-w-screen-2xl mx-auto">
    <div class="favorites__wrapper">
        <div class="container">
            <img src="{{ asset('img/favorites.png') }}" class="favorites__img" alt="избранное" height="220" width="230" />
            <h1 class="favorites__title">Добавьте товары в избранное</h1>
            <a href="#" class="favorites__btn">Перейти в каталог</a>
        </div>
    </div>
</section>
