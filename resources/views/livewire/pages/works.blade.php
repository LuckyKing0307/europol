@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush
<section class="works max-w-screen-2xl mx-auto">
    <div class="container">
        <h1 class="works__title">Наши реализованные проекты</h1>
        <p class="works__descr">
            Мы гордимся качеством наших работ и делимся примерами укладки и оформления полов для жилых и
            коммерческих помещений.
        </p>
        <div class="works__gallery">
            <img src="{{ asset('img/works-1.jpg') }}" alt="Наши работы" />
            <img src="{{ asset('img/works-2.jpg') }}" alt="Наши работы" />
            <img src="{{ asset('img/works-3.jpg') }}" alt="Наши работы" />
        </div>
        <div class="works-project works__project">
            <div class="works-project__wrapper">
                <h2 class="works-project__title">Описание проекта</h2>
                <div class="works-project__descr">
                    <p>
                        В рамках этого проекта основной задачей было создать тёплую и уютную атмосферу с
                        использованием износостойких и визуально привлекательных напольных покрытий.
                    </p>

                    <p>
                        Для отделки был выбран ламинат светлого древесного оттенка, который идеально вписался в
                        минималистичный стиль интерьера. Такое покрытие визуально расширяет пространство, придаёт
                        комнате ощущение чистоты и свежести.
                    </p>

                    <p>
                        Особое внимание уделялось подбору материала с высокой влагостойкостью и устойчивостью к
                        механическим повреждениям — оптимальное решение для активной жилой зоны.
                    </p>

                    <p>
                        Монтаж выполнен с идеальной геометрией швов, что подчёркивает уровень качества укладки. Все
                        элементы были предварительно адаптированы по размерам помещения, а переходы между зонами —
                        тщательно согласованы с дизайнером.
                    </p>
                </div>
            </div>
            <img src="{{ asset('img/works-1.jpg') }}" alt="Наши работы" class="works-prject__img" />
        </div>
        <div class="works__list">
            <div class="works__card works-card">
                <img src="{{ asset('img/works-4.jpg') }}" alt="Наши работ" class="works-card__img" />
                <h3 class="works-card__title">Современная гостиная с ламинатом под дуб</h3>
            </div>
            <div class="works__card works-card">
                <img src="{{ asset('img/works-5.jpg') }}" alt="Наши работ" class="works-card__img" />
                <h3 class="works-card__title">Тёплый и уютный дом ковролином</h3>
            </div>
        </div>
    </div>
</section>
