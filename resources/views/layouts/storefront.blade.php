<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Europol | Ламинат Паркет Ковролин')</title>
    <meta name="description" content="Европейские напольные покрытия...">
    <meta property="og:site_name" content="Europol"/>
    <meta property="og:title" content="@yield('title', 'Europol | Ламинат Паркет Ковролин')">
    <meta property="og:description" content="Европейские напольные покрытия...">
    <link rel="icon" href="{{ asset('icon.svg') }}">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('page-styles')
    @livewireStyles

    <!-- Lazy-loaded 3rd party styles -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="https://unpkg.com/beerslider/dist/BeerSlider.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.min.css" as="style" onload="this.onload=null;this.rel='stylesheet';">

    <!-- Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5BLYMWPZ7J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-5BLYMWPZ7J');
    </script>

    <script async src="https://mc.yandex.ru/metrika/tag.js"></script>
    <script>
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r;
            a.parentNode.insertBefore(k,a)
        })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(103355402, "init", {
            clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer"
        });
    </script>

    <script async>
        !function(f,b,e,v,n,t,s){
            if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)
        }(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '738261772126632');
        fbq('track', 'PageView');
    </script>
</head>

<body class="antialiased text-gray-900">
@livewire('components.navigation')

<main id="fullpage">
    {{ $slot }}
</main>

<div id="customChatButton">
    <img class="chat-avatar" src="{{asset('images/manager.webp')}}" alt="Тимур" loading="lazy">
    <div class="chat-info">
        <div class="chat-name">Тимур</div>
        <div class="chat-role">Консультант</div>
    </div>
</div>

<x-footer/>

<!-- External JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>
<script defer src="https://api-maps.yandex.ru/2.1/?apikey=ad99ba7e-6736-4900-9db3-b2f246c8b1a8&lang=ru_RU"></script>

<script defer>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init();

        const intervalId = setInterval(() => {
            const styleTag = [...document.querySelectorAll('style')]
                .find(el => el.textContent.includes('.amo-livechat_chat'));
            if (styleTag) {
                styleTag.remove();
                clearInterval(intervalId);
            }
        }, 300);

        const customButton = document.getElementById('customChatButton');

        amoSocialButton('onChatReady', () => {
            const amoBtn = document.querySelector('.amo-button');
            if (amoBtn) {
                customButton.style.display = 'none';
                amoBtn.style.setProperty('display', 'flex', 'important');
                amoBtn.style.width = '50px';
                amoBtn.style.height = '50px';
            }
        });

        customButton.addEventListener('click', () => amoSocialButton('runChatShow'));

        amoSocialButton('onChatShow', () => {
            customButton.style.display = 'none';
            const amoBtn = document.querySelector('.amo-button');
            amoBtn.style.setProperty('display', 'flex', 'important');
            amoBtn.style.width = '50px';
            amoBtn.style.height = '50px';
        });

        amoSocialButton('onChatHide', () => {
            customButton.style.display = 'flex';
            const amoBtn = document.querySelector('.amo-button');
            amoBtn.style.setProperty('display', 'none', 'important');
            amoBtn.style.width = 0;
            amoBtn.style.height = 0;
        });
    });
</script>

@livewireScripts
@stack('scripts')

<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=738261772126632&ev=PageView&noscript=1" alt="FB Pixel"/>
    <img src="https://mc.yandex.ru/watch/103355402" style="position:absolute; left:-9999px;" alt="Yandex Metrika" />
</noscript>
</body>
</html>
