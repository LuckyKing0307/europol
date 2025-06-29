<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Demo Storefront</title>
    <meta
        name="description"
        content="Example of an ecommerce storefront built with Lunar."
    >
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >
    <link
        href="{{ asset('css/main.css') }}"
        rel="stylesheet"
    >
    @stack('page-styles')
    <link
        rel="icon"
        href="{{ asset('favicon.svg') }}"
    >
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" rel="stylesheet"/>

    <link rel="stylesheet"
          href="https://unpkg.com/beerslider/dist/BeerSlider.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=ad99ba7e-6736-4900-9db3-b2f246c8b1a8&lang=ru_RU" type="text/javascript"></script>
</head>

<body class="antialiased text-gray-900">
@livewire('components.navigation')

<main>
    {{ $slot }}
</main>

<x-footer/>

@livewireScripts
{{----}}
<script>(function(a,m,o,c,r,m){a[m]={id:"430467",hash:"7462463ff36f16ac96d963c482521d04374a712c44e99cbb71f0e91dd62bdcd3",locale:"ru",inline:true,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>
<script>
    /**
     * 1. Каждые 5000 мс пытаемся найти iframe с нужным селектором.
     * 2. Как только нашли — прекращаем поиск (clearInterval),
     *    подписываемся на его загрузку (или сразу работаем, если уже загружен).
     * 3. Через 5 секунд после загрузки фрейма начинаем искать
     *    элемент с динамическим классом `styles_messages_inner__…`
     *    и повторяем проверку каждые 300 мс, пока не найдём.
     */

    const IFRAME_SELECTOR = 'iframe';   // ← поставь свой селектор
    const IFRAME_SCAN_DELAY = 5000;               // 5 cек — интервал, чтобы искать iframe
    const INNER_FIRST_DELAY = 5000;               // 5 cек — пауза до первого поиска внутри
    const INNER_SCAN_DELAY = 300;                 // 0.3 cек — интервал, чтобы искать элемент

    const iframeScanner = setInterval(() => {
        let iframe = document.querySelector(IFRAME_SELECTOR);
        if (!iframe) return;           // ещё не появился — ждём следующий цикл
        document.querySelector('.amo-button__link').click()
    }, IFRAME_SCAN_DELAY);
</script>
</body>

</html>
