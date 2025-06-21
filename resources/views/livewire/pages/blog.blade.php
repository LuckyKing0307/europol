@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush

<section class="blog max-w-screen-2xl mx-auto">
    <div class="container">
        <span class="blog__breadcrumbs">Главная / Блог / Как выбрать ламинат для дома</span>
        <div class="blog__container">
            <h1 class="blog__title">Как выбрать ламинат для дома</h1>
            <img src="{{ asset('img/blog-img.jpg') }}" class="blog__img" alt="Картинка блога" />
            <div class="blog__content">
                <h2 class="block-list__title block-list__title--intro">Введение</h2>
                <p class="block-list__text">
                    Ламинат остаётся одним из самых популярных покрытий благодаря своей доступности, прочности и
                    эстетике. Но как выбрать действительно качественный ламинат, подходящий именно вам?
                </p>

                <h2 class="block-list__title">На что обратить внимание при выборе:</h2>
                <ul class="block-list__list">
                    <li class="block-list__item">Класс износостойкости: для дома подойдёт 31–33 класс.</li>
                    <li class="block-list__item">Толщина доски: чем толще, тем прочнее и тише.</li>
                    <li class="block-list__item">Замковое соединение: удобнее при укладке.</li>
                    <li class="block-list__item">Фаска: защищает от сколов, визуально "разбивает" полотно.</li>
                    <li class="block-list__item">Фаска: защищает от сколов, визуально "разбивает" полотно.</li>
                </ul>

                <h2 class="block-list__title block-list__title--accent">Советы:</h2>
                <ul class="block-list__list">
                    <li class="block-list__item">Перед покупкой обязательно уточните, сколько м² в упаковке.</li>
                    <li class="block-list__item">
                        Храните упаковки горизонтально минимум 48 часов до укладки — для акклиматизации.
                    </li>
                </ul>
                <span class="blog__date">15 апреля 2024</span>
                <a href="#" class="blog__next">Следующая статья</a>
            </div>
        </div>
        <h2 class="blog__title">Читайте также</h2>
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
        </ul>
    </div>
</section>
