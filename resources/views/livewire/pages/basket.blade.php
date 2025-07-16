@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush
<section class="basket max-w-screen-2xl mx-auto">
    <div class="basket__wrapper">
        <div class="container">
            <img src="{{ asset('img/cart.png') }}" class="basket__img" alt="Корзина" height="211" width="229" />
            <h1 class="basket__title">В корзине пока нет товаров</h1>
            <a href="{{route('collection.view.all')}}" class="basket__btn">Перейти в каталог</a>
            <p class="basket__subtitle">
                Индивидуальный подбор товара по телефону
                <a href="tel:+998901234567" class="basket__phone">998 90 123 45 67</a>
            </p>
        </div>
    </div>
</section>
