@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush

<section class="b2b max-w-screen-2xl mx-auto">
    <div class="b2b__content">
        <div class="container">
            <h1 class="b2b__title">О компании Europol</h1>
            <p class="b2b__descr">
                Мы предлагаем продукцию только проверенных европейских брендов и сопровождаем клиента на каждом
                этапе — от подбора до монтажа.
            </p>
            <img src="{{ asset('img/b2b-1.png') }}" alt="О нас" class="b2b__img" />
        </div>
    </div>
    <div class="b2b__services b2b-services">
        <div class="container">
            <div class="b2b-services__card">
                <img src="{{ asset('img/b2b-2.png') }}" alt="О нас" />
                <div class="b2b-services__txt">
                    <h3 class="b2b-services__subtitle">Укладка и монтаж</h3>
                    <p class="b2b-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="b2b-services__card">
                <img src="{{ asset('img/b2b-3.png') }}" alt="О нас" />
                <div class="b2b-services__txt">
                    <h3 class="b2b-services__subtitle">Укладка и монтаж</h3>
                    <p class="b2b-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="b2b-services__card">
                <img src="{{ asset('img/b2b-4.png') }}" alt="О нас" />
                <div class="b2b-services__txt">
                    <h3 class="b2b-services__subtitle">Укладка и монтаж</h3>
                    <p class="b2b-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="b2b-services__card">
                <img src="{{ asset('img/b2b-5.png') }}" alt="О нас" />
                <div class="b2b-services__txt">
                    <h3 class="b2b-services__subtitle">Укладка и монтаж</h3>
                    <p class="b2b-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
        </div>
    </div>
    <div class="b2b-contact">
        <h2 class="b2b-contact__title">Оставьте заявку, и мы свяжемся с вами в течение 1 рабочего дня</h2>
        <div class="container">
            <img src="{{ asset('img/b2b-6.png') }}" alt="О нас" class="b2b-contact__img" />
            <div class="b2b-form__wrapper">
                <form class="b2b__form b2b-form">
                    <input class="b2b-form__input" type="text" placeholder="Имя" required />
                    <input class="b2b-form__input" type="tel" placeholder="Телефон" required />
                    <input class="b2b-form__input" type="email" placeholder="Электронная почта" required />
                    <textarea class="b2b-form__textarea" placeholder="Сообщение" required></textarea>
                    <button class="b2b-form__button" type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</section>
