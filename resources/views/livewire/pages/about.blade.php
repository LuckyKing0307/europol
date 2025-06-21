@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush
<section class="about max-w-screen-2xl mx-auto">
    <div class="about__content">
        <div class="container">
            <h1 class="about__title">О компании Europol</h1>
            <div class="about__descr">
                <p>
                    Europol — это команда профессионалов с более чем 15-летним опытом в сфере напольных покрытий.
                </p>
                <p>
                    Мы предлагаем продукцию только проверенных европейских брендов и сопровождаем клиента на каждом
                    этапе — от подбора до монтажа.
                </p>
            </div>
        </div>
        <img src="{{ asset('img/about-1.png') }}" alt="О нас" class="about__img" />
    </div>
    <div class="about__services about-services">
        <h2 class="about-services__title">Чем мы занимаемся</h2>
        <div class="container">
            <div class="about-services__card">
                <img src="{{ asset('img/about-2.png')}}" alt="О нас" />
                <div class="about-services__txt">
                    <h3 class="about-services__subtitle">Укладка и монтаж</h3>
                    <p class="about-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="about-services__card">
                <img src="{{ asset('img/about-3.png') }}" alt="О нас" />
                <div class="about-services__txt">
                    <h3 class="about-services__subtitle">Укладка и монтаж</h3>
                    <p class="about-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="about-services__card">
                <img src="{{ asset('img/about-4.png') }}" alt="О нас" />
                <div class="about-services__txt">
                    <h3 class="about-services__subtitle">Укладка и монтаж</h3>
                    <p class="about-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="about-services__card">
                <img src="{{ asset('img/about-5.png') }}" alt="О нас" />
                <div class="about-services__txt">
                    <h3 class="about-services__subtitle">Укладка и монтаж</h3>
                    <p class="about-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
        </div>
    </div>
    <div class="about-aim about__aim">
        <h2 class="about-aim__title">Наша цель — не просто продать ламинат.</h2>
        <p class="about-aim__descr">
            Мы помогаем создать уют в доме, выбирая лучшие покрытия и сопровождая клиента на каждом этапе.
        </p>
    </div>
</section>
