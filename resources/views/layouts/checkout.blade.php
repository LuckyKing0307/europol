<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5BLYMWPZ7J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5BLYMWPZ7J');
    </script>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>@yield('title', 'Europol | Ламинат Паркет Ковролин')</title>
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
        href="{{ asset('icon.svg') }}"
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
<div id="customChatButton">
    <img class="chat-avatar" src="{{asset('images/manager.png')}}" alt="Тимур">
    <div class="chat-info">
        <div class="chat-name">Тимур</div>
        <div class="chat-role">Консультант</div>
    </div>
</div>
<x-footer/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
@livewireScripts
<script>(function(a,m,o,c,r,m){a[m]={id:"430467",hash:"7462463ff36f16ac96d963c482521d04374a712c44e99cbb71f0e91dd62bdcd3",locale:"ru",inline:true,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>

<script defer>
    amoSocialButton('onChatReady', function () {
        document.querySelector('.amo-button').style.display = 'none';
    })
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function(){
            amoSocialButton('onChatReady', function () {
                amoSocialButton('runChatShow');
            });
        }, 5000); // небольшая задержка для надёжности
    });
    // Открытие AmoCRM чата по клику
    document.getElementById('customChatButton').addEventListener('click', function (e) {
        amoSocialButton('runChatShow');
    });
    amoSocialButton('onChatShow', function () {
        document.getElementById('customChatButton').style.display = 'none';
        document.querySelector('.amo-button').style.setProperty('display', 'flex', 'important');
        document.querySelector('.amo-button').style.width = '50px';
        document.querySelector('.amo-button').style.height = '50px';
    });
    amoSocialButton('onChatHide', function () {
        document.getElementById('customChatButton').style.display = 'flex';
        document.querySelector('.amo-button').style.setProperty('display', 'none', 'important');
        document.querySelector('.amo-button').style.width = 0;
        document.querySelector('.amo-button').style.height = 0;
    });
</script>
</body>

</html>
