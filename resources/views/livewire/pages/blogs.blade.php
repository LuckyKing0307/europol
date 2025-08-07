@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush

<section class="blogs max-w-screen-2xl mx-auto">
    <div class="container">
        <h1 class="blogs__title">Блог Europol</h1>
        <p class="blogs__descr">Полезные советы, обзоры и идеи для вашего интерьера</p>
        <input
            type="text"
            class="blogs__search"
            aria-label="Поиск блога"
            wire:model.live="search"
        />
        <ul class="blogs-tabs__list">
            @foreach ($categories as $cat)
                <li class="blogs-tabs__item">
                    <button
                        wire:click="setCategory('{{ $cat }}')"
                        class="blogs-tabs__btn {{ $this->category === $cat ? 'blogs-tabs__btn--active' : '' }}"
                    >
                        {{ ucfirst($cat) }}
                    </button>
                </li>
            @endforeach
        </ul>
        <ul class="blogs__list blogs-list">
            @forelse ($blogs as $blog)
                <li class="blogs-list__item">
                    <a href="{{ route('blog.view', ['slug' => $blog->slug]) }}">
                        <article class="blogs-list__article blogs-article">
                            <img src="{{ asset('storage/' . $blog->og_image) }}" alt="{{ $blog->title }}" />
                            <div class="blogs-article__txt">
                                <h2 class="blogs-article__title">{{ $blog->title }}</h2>
                                <p class="blogs-article__descr">
                                    {{ \Illuminate\Support\Str::limit($blog->meta_description, 120) }}
                                </p>
                                <span class="blogs-article__date">
                            {{ \Carbon\Carbon::parse($blog->updated_at)->translatedFormat('d F Y') }}
                        </span>
                            </div>
                        </article>
                    </a>
                </li>
            @empty
                <li>Пока нет статей</li>
            @endforelse
        </ul>
        <div class="pagination">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
