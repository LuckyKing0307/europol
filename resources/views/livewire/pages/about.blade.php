@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush
<section class="about max-w-screen-2xl mx-auto">
    <div class="about__content">
        <div class="">
            <h1 class="about__title">О компании Europol</h1>
            <div class="about__descr">
                <p>
                    Europol — это не просто магазин напольных покрытий. Это надежный партнер с 2007 года дизайнеров интерьера, застройщиков и людей, кто просто ценит качество и комфорт и хочет всё самое лучшее  для своего дома/офиса.
                </p>
                <p>
                    Основанная в 2007 году предпринмателем Алишером Авазовым, компания строилась на принципах, которые мы сохраняем до сих пор: честность, надежность и ответственность перед каждым клиентом.
                </p>
            </div>
        </div>
        <img src="{{ asset('img/alisher_avazov.jpg') }}" alt="О нас" class="about__img" />
    </div>
    <div class="about__services about-services">
        <h2 class="about-services__title">Сегодня Europol — это 8 шоурумов в Ташкенте</h2>
        <div class="container">
            <div class="about-services__card">
                <img src="{{ asset('img/1rm.webp')}}" alt="О нас" />
            </div>
            <div class="about-services__card">
                <img src="{{ asset('img/2rm.webp') }}" alt="О нас" />

            </div>
            <div class="about-services__card">
                <img src="{{ asset('img/3rm.webp') }}" alt="О нас" />
            </div>
{{--            <div class="about-services__card">--}}
{{--                <img src="{{ asset('img/about-5.png') }}" alt="О нас" />--}}
{{--                <div class="about-services__txt">--}}
{{--                    <h3 class="about-services__subtitle">Укладка и монтаж</h3>--}}
{{--                    <p class="about-services__descr">Профессиональная укладка всех типов покрытий</p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="about-aim about__aim">
        <h2 class="about-aim__title"> -Официальные поставки от HARO, Coswick, Karelia, Quick-Step, Balsan и других европейских брендов</h2>
        <div class="about-services__card" style="max-width: 100%;">
            <img src="{{ asset('img/tovar.webp') }}" alt="О нас" />
        </div>
    </div>
    <div class="about-aim about__aim">
        <h2 class="about-aim__title">-1000+ моделей покрытий в наличии</h2>
        <div class="about-services__card" style="max-width: 100%; display: flex; justify-content: space-around; ">
            <img src="{{ asset('img/sclad1.webp') }}" alt="Фото со склада" style="width: 40%;"/>
            <img src="{{ asset('img/sclad2.webp') }}" alt="Фото со склада" style="width: 40%;"/>
        </div>
        <div class="about-services__card" style="max-width: 100%; display: flex; align-items: center;">
            <p class="about-services__descr">
                -Партнёрство с крупнейшими застройщиками страны: Modera Towers, Murad Buildings и др. <br>
                -Менеджеры с опытом до 10 лет — знают каждую коллекцию в деталях <br>
                -Бесплатный выезд дизайнера на объект (Альберт-15 лет опыта работы)— помогает оценить стяжку, подобрать нужный формат, текстуру и покрытие под ваш интерьер
            </p>
            <img src="{{ asset('img/albert.webp') }}" alt="Фото со склада"  style="width: 50%;"/>
        </div>
    </div>
</section>
