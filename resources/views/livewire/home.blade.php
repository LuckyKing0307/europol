<div>
    @livewire('components.pop-up')
    <x-welcome-banner />
    @livewire('categories-component')
{{--    @livewire('top-sales')--}}
    <section class="mx-auto max-w-screen-xl content_block">
        <div class="block_title" style="text-align: center;">{{ __('why_choose_us.title') }}</div>
        <div class="information">
            <h3 class="info_block_title" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">ШИРОКИЙ ВЫБОР НАПОЛЬНЫХ ПОКРЫТИЙ</h3>
            <div class="info_block" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
                <img loading="lazy" src="{{ asset('img/1.webp') }}" alt="Официальные бренды">
                <p class="info_block_text">Продаем только официальные бренды европейских производителей. Более 1000 моделей в наличии. Найдем подходящий пол именно под ваш дизайн интерьера. И Подберем подходящий пол под любой дизайн: классика, сканди, минимализм, арт-деко, модерн.</p>
            </div>
            <h3 class="info_block_title" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">Качество проверенное годами</h3>
            <div class="info_block" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
                <p class="info_block_text">— Haro — полы, признанные №1 в Германии и со 150 летней историей <br>
                    — Coswick — выбор дизайнеров интерьера в США и Канаде <br>
                    — Quick-Step — бельгийский лидер с инновационными замками. <br>
                    — Karelia — финская надежность с северным характером
                </p>
                <img loading="lazy" src="{{ asset('img/2.webp') }}" alt="Полы №1 в Германии">
            </div>
            <h3 class="info_block_title" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">Профессиональная консультация</h3>
            <div class="info_block" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
                <img loading="lazy" src="{{ asset('img/3.webp') }}" alt="Реальная профессиональная помощь">
                <p class="info_block_text">Это не просто консультация. Это реальная профессиональная помощь на уровне вашего проекта и в точных расчетах, честных рекомендациях.
                    <br><br>

                    Наш дизайнер интерьера Альберт (Стаж +15 лет) БЕСПЛАТНО выезжает на ваш объект, оценивает вашу стяжку, задачи интерьера и помогает выбрать оптимальный вариант.
                    <br><br>
                    Менеджеры с опытом до 10 лет знают каждую марку, каждое покрытие и все нюансы укладки.
                    Мы не просто «поможем выбрать». Мы найдем оптимальное решение, в котором вам будет комфортно жить.
                </p>
            </div>
            <h3 class="info_block_title" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">Доставка</h3>
            <div class="info_block" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
                <p class="info_block_text">Используем собственную логистику, поэтому вы точно знаете сроки. Бесплатно доставим по г.Ташкент паркет, ламинат, ковролин, линолеум Европейских брендов. Все товары в наличии на складе. Имеется также доставка по Узбекистану.
                </p>
                <img loading="lazy" src="{{ asset('img/4.webp') }}" alt="Логистика">
            </div>
        </div>
    </section>
    <livewire:before-after-component lazy="" />
    <livewire:components.review lazy="" />
{{--    <section class="wave-block">--}}
{{--        <div class="wave-block-content">--}}
{{--            <section class="mx-auto max-w-screen-2xl flex justify-between">--}}
{{--                <div class="contact_us">--}}
{{--                    <h2 class="contact_us__title">Свяжитесь с нами</h2>--}}
{{--                    <p class="contact_us__desc">--}}
{{--                        Оставьте заявку, и мы вам<br>--}}
{{--                        перезвоним в ближайшее время--}}
{{--                    </p>--}}
{{--                    <ul class="contact_us__list">--}}
{{--                        <li class="contact_us__item">--}}
{{--      <span class="contact_us__icon">--}}
{{--        <!-- Локация SVG -->--}}
{{--        <svg width="16" height="16" fill="none" viewBox="0 0 20 20"><path stroke="#000" stroke-width="1.5" d="M10 18c5.5-7 6-8.5 6-10A6 6 0 1 0 4 8c0 1.5.5 3 6 10Zm0 0c1.381 0 2.5-1.119 2.5-2.5S11.381 13 10 13s-2.5 1.119-2.5 2.5S8.619 18 10 18Z"/></svg>--}}
{{--      </span>--}}
{{--                            ул. Амирa Темура, 12. Ташкент--}}
{{--                        </li>--}}
{{--                        <li class="contact_us__item">--}}
{{--      <span class="contact_us__icon">--}}
{{--        <!-- Телефон SVG -->--}}
{{--        <svg width="16" height="16" fill="none" viewBox="0 0 20 20"><path stroke="#000" stroke-width="1.5" d="M17.5 15.5v2a1 1 0 0 1-1.16.99c-8.6-1.1-12.38-8.14-13.24-13.24A1 1 0 0 1 4.5 2.5h2a1 1 0 0 1 1 1c.048.837.218 1.662.5 2.45a1 1 0 0 1-.22 1.08L6.19 8.56a11.97 11.97 0 0 0 5.25 5.25l2.03-1.59a1 1 0 0 1 1.08-.22c.788.282 1.613.452 2.45.5a1 1 0 0 1 1 1Z"/></svg>--}}
{{--      </span>--}}
{{--                            +998 12 345 67 89--}}
{{--                        </li>--}}
{{--                        <li class="contact_us__item">--}}
{{--      <span class="contact_us__icon">--}}
{{--        <!-- Почта SVG -->--}}
{{--        <svg width="16" height="16" fill="none" viewBox="0 0 20 20"><path stroke="#000" stroke-width="1.5" d="M2.5 5A2.5 2.5 0 0 1 5 2.5h10A2.5 2.5 0 0 1 17.5 5v10a2.5 2.5 0 0 1-2.5 2.5H5A2.5 2.5 0 0 1 2.5 15V5Zm0 0l7.5 5L17.5 5"/></svg>--}}
{{--      </span>--}}
{{--                            <a href="mailto:info@site.com" class="contact_us__mail">info@site.com</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                @livewire('contact-form')--}}
{{--            </section>--}}
{{--        </div>--}}
{{--    </section>--}}

</div>

