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
        content="Европейские напольные покрытия для тех, кто выбирает качество
Паркет. Ламинат. Ковролин. ПВХ/SPC. Плинтусы. Клеи. Всё в 1 месте.

+1000 товаров в наличии.
Полы для дома, бизнеса и жизни — с 2007 в Узбекистане.
Даем официальную гарантию до 35 лет."
    >
    <meta property="og:site_name" content="Europol"/>
    <meta property="og:title" content="@yield('title', 'Europol | Ламинат Паркет Ковролин')">
    <meta property="og:description" content="Европейские напольные покрытия для тех, кто выбирает качество
Паркет. Ламинат. Ковролин. ПВХ/SPC. Плинтусы. Клеи. Всё в 1 месте.

+1000 товаров в наличии.
Полы для дома, бизнеса и жизни — с 2007 в Узбекистане.
Даем официальную гарантию до 35 лет.">
    @stack('page-styles')
    <link
        rel="icon"
        href="{{ asset('icon.svg') }}"
    >
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app_main.css', 'resources/css/main.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://unpkg.com/beerslider/dist/BeerSlider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=ad99ba7e-6736-4900-9db3-b2f246c8b1a8&lang=ru_RU" type="text/javascript"></script>
</head>
<!-- Yandex.Metrika counter -->
<script>(function(){var dbpr=100;if(Math.random()*100>100-dbpr){var d="dbbRum",w=window,o=document,a=addEventListener,scr=o.createElement("script");scr.async=!0;w[d]=w[d]||[];w[d].push(["presampling",dbpr]);["error","unhandledrejection"].forEach(function(t){a(t,function(e){w[d].push([t,e])});});scr.src="https://cdn.debugbear.com/sP6EEzgCU2rl.js";o.head.appendChild(scr);}})()</script>
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){
            (m[i].a=m[i].a||[]).push(arguments)
        };
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {
            if (document.scripts[j].src === r) { return; }
        }
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r;
        a.parentNode.insertBefore(k,a)
    })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(103355402, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
    });
</script>
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '738261772126632');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=738261772126632&ev=PageView&noscript=1"
    /></noscript>
<noscript>
    <div>
        <img src="https://mc.yandex.ru/watch/103355402" style="position:absolute; left:-9999px;" alt="" />
    </div>
</noscript>
<!-- /Yandex.Metrika counter -->
<body class="antialiased text-gray-900">
@livewire('components.navigation')
<div id="loader">
    <div class="logo-wrapper">
        <svg class="gold-logo" viewBox="0 0 298 68" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="gold-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#FFD700" />
                    <stop offset="100%" stop-color="#FFF8DC" />
                </linearGradient>

                <mask id="shine-mask">
                    <rect x="-100%" y="0" width="300%" height="100%" fill="url(#shine)" />
                </mask>

                <linearGradient id="shine" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="white" stop-opacity="0" />
                    <stop offset="50%" stop-color="white" stop-opacity="1" />
                    <stop offset="100%" stop-color="white" stop-opacity="0" />
                </linearGradient>
            </defs>

            <g fill="url(#gold-gradient)" mask="url(#shine-mask)">
                <!-- Здесь все path'ы твоего лого -->
                <path d="M98.1206 1.20898V9.90898H69.9806V21.979H95.5306V30.679H69.9806V44.159H98.1206V52.819H59.6406V1.20898H98.1206Z"/>
                <path d="M102 15.2012V44.0812C102 44.0812 103.92 54.1512 114.81 54.1912C114.81 54.1912 122.88 54.6212 126.92 47.8812V53.2512H135.78V15.2012H126.69V36.8312C126.69 36.8312 126.69 45.8812 118.34 46.0412C118.34 46.0412 112.5 46.7112 111.33 41.2212V15.2012H102Z"/>
                <path d="M141.609 15.199V53.249H150.769V31.929C150.769 31.929 151.009 22.789 164.069 23.409V14.839C164.069 14.839 154.199 13.169 150.489 21.889V15.189H141.609V15.199Z"/>
                <path d="M196.561 20.1505C193.061 16.6405 188.221 14.4805 182.891 14.4805C172.211 14.4805 163.551 23.1405 163.551 33.8205V34.5005C163.551 45.1805 172.211 53.8305 182.891 53.8305C193.571 53.8305 202.221 45.1805 202.221 34.5005V33.8205C202.221 28.4905 200.061 23.6505 196.561 20.1505ZM192.771 36.4305C192.771 41.8805 188.341 46.3005 182.901 46.3005C177.461 46.3005 173.031 41.8705 173.031 36.4305V31.8905C173.031 26.4305 177.451 22.0205 182.901 22.0205C185.621 22.0205 188.091 23.1205 189.881 24.9105C191.671 26.6905 192.771 29.1705 192.771 31.8905V36.4305Z"/>
                <path d="M278.592 20.1505C275.092 16.6405 270.252 14.4805 264.922 14.4805C254.242 14.4805 245.582 23.1405 245.582 33.8205V34.5005C245.582 45.1805 254.242 53.8305 264.922 53.8305C275.602 53.8305 284.252 45.1805 284.252 34.5005V33.8205C284.252 28.4905 282.092 23.6505 278.592 20.1505ZM274.802 36.4305C274.802 41.8805 270.372 46.3005 264.932 46.3005C259.492 46.3005 255.062 41.8705 255.062 36.4305V31.8905C255.062 26.4305 259.482 22.0205 264.932 22.0205C267.652 22.0205 270.122 23.1205 271.912 24.9105C273.702 26.6905 274.802 29.1705 274.802 31.8905V36.4305Z"/>
                <path d="M243.441 29.9396C241.351 14.0096 227.561 14.4796 227.561 14.4796C217.741 14.3196 214.981 20.5496 214.981 20.5496V15.2396H205.891V67.6696H214.981V48.3796C219.891 54.7596 226.361 54.1196 226.361 54.1196C236.181 54.0196 239.271 48.5896 239.271 48.5896C245.341 42.3096 243.451 29.9296 243.451 29.9296L243.441 29.9396ZM233.831 38.0896C233.831 38.0896 233.311 45.7196 224.631 46.2996C224.631 46.2996 218.251 46.6096 215.641 39.8696C215.641 39.8696 214.751 34.0696 215.271 30.6696C215.271 30.6696 215.691 24.0496 222.241 22.3996C223.951 21.9596 225.771 21.9796 227.471 22.4596C229.851 23.1396 233.001 24.8996 233.821 29.5796V38.0896H233.831Z"/>
                <path d="M297.523 1H288.223V53.25H297.523V1Z"/>
                <path d="M0 26.6699L11.12 53.3399H18.54L7.42 26.6699H0Z"/>
                <path d="M3.71875 0.07L25.9587 53.34L33.3987 53.3L11.1187 0L3.71875 0.07Z"/>
                <path d="M18.5703 0.0703125L40.8303 53.3003H48.2503L25.9903 0.0703125H18.5703Z"/>
                <path d="M33.418 0.0703125L44.528 26.6903H51.958L40.838 0.0703125H33.418Z"/>
            </g>
        </svg>
    </div>
</div>
<main id="fullpage">
    {{ $slot }}
</main>
<div id="customChatButton">
    <img class="chat-avatar" src="{{asset('images/manager.webp')}}" alt="Тимур">
    <div class="chat-info">
        <div class="chat-name">Тимур</div>
        <div class="chat-role">Консультант</div>
    </div>
</div>
<x-footer/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
@livewireScripts
<script>(function(a,m,o,c,r,m){a[m]={id:"430467",hash:"7462463ff36f16ac96d963c482521d04374a712c44e99cbb71f0e91dd62bdcd3",locale:"ru",inline:true,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>

<script defer>
    const interval = setInterval(() => {
        const styleTag = [...document.querySelectorAll('style')]
            .find(el => el.textContent.includes('.amo-livechat_chat'));

        if (styleTag) {
            styleTag.remove(); // удаляем стили виджета
            clearInterval(interval);
        }
    }, 300);
    window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        loader.style.opacity = '0';
        setTimeout(() => loader.remove(), 500);
    });
    amoSocialButton('onChatReady', function () {
        document.querySelector('.amo-button').style.display = 'none';
    })
    document.addEventListener('DOMContentLoaded', function() {
        const intervalId = setInterval(function () {
            amoSocialButton('onChatReady', function () {
                amoSocialButton('runChatShow');

                const customButton = document.getElementById('customChatButton');
                const amoBtn = document.querySelector('.amo-button');

                if (customButton && amoBtn) {
                    customButton.style.display = 'none';
                    amoBtn.style.setProperty('display', 'flex', 'important');
                    amoBtn.style.width = '50px';
                    amoBtn.style.height = '50px';
                    clearInterval(intervalId);
                }
            });

        }, 1000);
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
@stack('scripts')
</body>

</html>
