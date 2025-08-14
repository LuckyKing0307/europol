<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>

    <title>@yield('title', 'Europol | Ламинат Паркет Ковролин')</title>
    <meta name="title" content="@yield('title', 'Europol — Ламинат, паркет и ковролин в Ташкенте, Узбекистан')"/>
    <meta name="description"
          content='@yield("description", "Европейские напольные покрытия. Паркет, ламинат, ковролин, ПВХ/SPC, плинтусы, клеи. 1000+ товаров в наличии. Гарантия до 35 лет. С 2007 в Узбекистане.")'/>

    <meta property="og:site_name" content="Europol"/>
    <meta property="og:title" content="@yield('title', 'Europol | Ламинат Паркет Ковролин')"/>
    <meta property="og:description"
          content='@yield("description", "Европейские напольные покрытия. Паркет, ламинат, ковролин, ПВХ/SPC, плинтусы, клеи. 1000+ товаров в наличии. Гарантия до 35 лет. С 2007 в Узбекистане.")'/>

    <link rel="icon" href="{{ asset('icon.svg') }}"/>
    @vite(['resources/css/app.css','resources/css/app_main.css','resources/css/main.css','resources/js/app.js'])
    <link rel="preconnect" href="https://cdn.jsdelivr.net"/>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com"/>
    <link rel="preconnect" href="https://unpkg.com"/>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://unpkg.com/beerslider/dist/BeerSlider.css" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.min.css" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    @stack('page-styles')
    @livewireStyles
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Store",
          "name": "Europol",
          "image": "{{ asset('images/og-main.jpg') }}",
          "url": "{{ url('/') }}",
          "telephone": "+998555100102",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Ташкент",
            "addressRegion": "UZ",
            "streetAddress": "Кичик Халка Йули, 88"
          },
          "areaServed": "UZ",
          "priceRange": "$$",
          "openingHours": ["Mo-Sa 10:00-20:00", "Su 10:00-18:00"],
          "sameAs": [
            "https://t.me/europol_uzbekistan",
            "https://www.facebook.com/europol.uz"
          ]
        }
    </script>
</head>

<body class="antialiased text-gray-900">
{{-- Навигация --}}
@livewire('components.navigation')
<main>
    {{ $slot }}
</main>

{{-- Быстрые кнопки связи --}}
<div class="btns_contacts">
    <a href="tel:+998901234567" class="telegram" target="_blank" rel="noopener">
        <img src="{{ asset('img/contac_phone.png') }}" alt="Позвонить" width="50" height="50" loading="lazy"
             decoding="async">
    </a>
    <a href="https://t.me/europol_uzbekistan" class="telegram" target="_blank" rel="noopener">
        <img src="{{ asset('img/telegram.png') }}" alt="Telegram" width="50" height="50" loading="lazy"
             decoding="async">
    </a>
</div>

{{-- Кастомная кнопка AmoCRM --}}
<div id="customChatButton">
    <img class="chat-avatar" src="{{ asset('images/manager.webp') }}" alt="Тимур" width="56" height="56" loading="lazy"
         decoding="async">
    <div class="chat-info">
        <div class="chat-name">Тимур</div>
        <div class="chat-role">Консультант</div>
    </div>
</div>

<x-footer/>

@livewireScripts
@stack('scripts')
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('loader')?.classList.add('hidden');
    });

    const loadScript = (src, {defer = true, async = false, type} = {}) => new Promise((resolve, reject) => {
        const s = document.createElement('script');
        s.src = src;
        if (type) s.type = type;
        if (defer) s.defer = true;
        if (async) s.async = true;
        s.onload = resolve;
        s.onerror = reject;
        document.head.appendChild(s);
    });

    const idle = (cb) => (window.requestIdleCallback ? requestIdleCallback(cb, {timeout: 5000}) : setTimeout(cb, 1500));

    document.addEventListener('DOMContentLoaded', async () => {
        if (document.querySelector('.range-slider')) {
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js', {defer: true});
            document.querySelectorAll('.range-slider').forEach(el => {
                noUiSlider.create(el, {start: [0, 100], connect: true, range: {min: 0, max: 100}});
            });
        }
        if (document.querySelector('.beer-slider')) {
            document.querySelectorAll('.beer-slider').forEach(el => new BeerSlider(el));
        }
    });
    const initAmo = () => {
        (function (a, m, o, c, r, m2) {
            a[m2] = {
                id: "430467",
                hash: "7462463ff36f16ac96d963c482521d04374a712c44e99cbb71f0e91dd62bdcd3",
                locale: "ru",
                inline: true,
                setMeta: function (p) {
                    (this.params = this.params || []).push(p)
                }
            };
            a[o] = a[o] || function () {
                (a[o].q = a[o].q || []).push(arguments)
            };
            const d = a.document, s = d.createElement('script');
            s.async = true;
            s.id = m2 + '_script';
            s.src = 'https://gso.amocrm.ru/js/button.js';
            d.head && d.head.appendChild(s);
        })(window, 0, 'amoSocialButton', 0, 0, 'amo_social_button');

        window.amoSocialButton && amoSocialButton('onChatReady', function () {
            const amoBtn = document.querySelector('.amo-button');
            if (amoBtn) amoBtn.style.setProperty('display', 'none', 'important');
        });

        const customBtn = document.getElementById('customChatButton');
        customBtn?.addEventListener('click', () => amoSocialButton('runChatShow'));

        amoSocialButton('onChatShow', function () {
            const amoBtn = document.querySelector('.amo-button');
            if (amoBtn) {
                amoBtn.style.setProperty('display', 'flex', 'important');
                amoBtn.style.width = '50px';
                amoBtn.style.height = '50px';
            }
            customBtn && (customBtn.style.display = 'none');
        });

        amoSocialButton('onChatHide', function () {
            const amoBtn = document.querySelector('.amo-button');
            if (amoBtn) amoBtn.style.setProperty('display', 'none', 'important');
            customBtn && (customBtn.style.display = 'flex');
        });
    };

    const loadAnalytics = () => {
        (function () {
            const s = document.createElement('script');
            s.src = 'https://www.googletagmanager.com/gtag/js?id=G-5BLYMWPZ7J';
            s.async = true;
            document.head.appendChild(s);
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments)
            };window.gtag = gtag;
            gtag('js', new Date());
            gtag('config', 'G-5BLYMWPZ7J');
        })();
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0];
            k.async = 1;
            k.src = r;
            a.parentNode.insertBefore(k, a)
        })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(103355402, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: false,
            ecommerce: "dataLayer"
        });
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s);
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '738261772126632');
        fbq('track', 'PageView');
        (function () {
            const dbpr = 100; // процент сэмплинга
            if (Math.random() * 100 > 100 - dbpr) {
                const s = document.createElement('script');
                s.async = true;
                s.src = 'https://cdn.debugbear.com/sP6EEzgCU2rl.js';
                document.head.appendChild(s);
                window.dbbRum = window.dbbRum || [];
                window.dbbRum.push(["presampling", dbpr]);
            }
        })();
        initAmo();
    };

    window.addEventListener('load', () => idle(loadAnalytics));
</script>
</body>
</html>
