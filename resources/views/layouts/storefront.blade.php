<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>@yield('title', config('app.name'))</title>
    <meta name="title" content="@yield('title', config('app.name'))">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
@livewireScripts
<script>(function(a,m,o,c,r,m){a[m]={id:"430467",hash:"7462463ff36f16ac96d963c482521d04374a712c44e99cbb71f0e91dd62bdcd3",locale:"ru",inline:false,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>

<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        setInterval(function(){
            amoSocialButton('onChatReady', function () {
                amoSocialButton('runChatShow');
            });
        }, 100); // небольшая задержка для надёжности
    });
</script>
</body>

</html>
