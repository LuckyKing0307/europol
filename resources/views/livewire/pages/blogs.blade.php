@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush

<section class="blogs max-w-screen-2xl mx-auto">
    <div class="container">
        <h1 class="blogs__title">Блог Europol</h1>
        <p class="blogs__descr">Полезные советы, обзоры и идеи для вашего интерьера</p>
        <input type="text" name="Search" class="blogs__search" aria-label="Поиск блога" />
        <ul class="blogs-tabs__list">
            <li class="blogs-tabs__item">
                <button class="blogs-tabs__btn blogs-tabs__btn--active">Ламинат</button>
            </li>
            <li class="blogs-tabs__item"><button class="blogs-tabs__btn">Паркет</button></li>
            <li class="blogs-tabs__item"><button class="blogs-tabs__btn">Виниловые полы</button></li>
            <li class="blogs-tabs__item"><button class="blogs-tabs__btn">Укладка</button></li>
            <li class="blogs-tabs__item"><button class="blogs-tabs__btn">Уход</button></li>
        </ul>
        <ul class="blogs__list blogs-list">
            <li class="blogs-list__item">
                <article class="blogs-list__article blogs-article">
                    <img src="{{ asset('img/blogs.jpg') }}" alt="Блоги" />
                    <div class="blogs-article__txt">
                        <h2 class="blogs-article__title">Как выбрать ламинат для дома</h2>
                        <p class="blogs-article__descr">
                            Советы по подбору ламината. На что обратить внимание перед покупкой
                        </p>
                        <span class="blogs-article__date"> 15 апреля 2024 </span>
                    </div>
                </article>
            </li>
            <li class="blogs-list__item">
                <article class="blogs-list__article blogs-article">
                    <img src="{{ asset('img/blogs.jpg') }}" alt="Блоги" />
                    <div class="blogs-article__txt">
                        <h2 class="blogs-article__title">Как выбрать ламинат для дома</h2>
                        <p class="blogs-article__descr">
                            Советы по подбору ламината. На что обратить внимание перед покупкой
                        </p>
                        <span class="blogs-article__date"> 15 апреля 2024 </span>
                    </div>
                </article>
            </li>
            <li class="blogs-list__item">
                <article class="blogs-list__article blogs-article">
                    <img src="{{ asset('img/blogs.jpg') }}" alt="Блоги" />
                    <div class="blogs-article__txt">
                        <h2 class="blogs-article__title">Как выбрать ламинат для дома</h2>
                        <p class="blogs-article__descr">
                            Советы по подбору ламината. На что обратить внимание перед покупкой
                        </p>
                        <span class="blogs-article__date"> 15 апреля 2024 </span>
                    </div>
                </article>
            </li>
            <li class="blogs-list__item">
                <article class="blogs-list__article blogs-article">
                    <img src="{{ asset('img/blogs.jpg') }}" alt="Блоги" />
                    <div class="blogs-article__txt">
                        <h2 class="blogs-article__title">Как выбрать ламинат для дома</h2>
                        <p class="blogs-article__descr">
                            Советы по подбору ламината. На что обратить внимание перед покупкой
                        </p>
                        <span class="blogs-article__date"> 15 апреля 2024 </span>
                    </div>
                </article>
            </li>
            <li class="blogs-list__item">
                <article class="blogs-list__article blogs-article">
                    <img src="{{ asset('img/blogs.jpg') }}" alt="Блоги" />
                    <div class="blogs-article__txt">
                        <h2 class="blogs-article__title">Как выбрать ламинат для дома</h2>
                        <p class="blogs-article__descr">
                            Советы по подбору ламината. На что обратить внимание перед покупкой
                        </p>
                        <span class="blogs-article__date"> 15 апреля 2024 </span>
                    </div>
                </article>
            </li>
            <li class="blogs-list__item">
                <article class="blogs-list__article blogs-article">
                    <img src="{{ asset('img/blogs.jpg') }}" alt="Блоги" />
                    <div class="blogs-article__txt">
                        <h2 class="blogs-article__title">Как выбрать ламинат для дома</h2>
                        <p class="blogs-article__descr">
                            Советы по подбору ламината. На что обратить внимание перед покупкой
                        </p>
                        <span class="blogs-article__date"> 15 апреля 2024 </span>
                    </div>
                </article>
            </li>
        </ul>
        <div class="pagination">
            <img src="{{ asset('img/arrow-previous.svg') }}" alt="Предыдущая" class="pagination__arrow" />
            <div class="pagination__numbers">
                <div class="pagination__number pagination__number--active">1</div>
                <div class="pagination__number">2</div>
                <div class="pagination__number">3</div>
                <div class="pagination__number">4</div>
                <div class="pagination__number">5</div>
                <div class="pagination__number">6</div>
            </div>
            <img src="{{ asset('img/arrow-next.svg') }}" alt="Следующая" class="pagination__arrow" />
        </div>
    </div>
</section>
