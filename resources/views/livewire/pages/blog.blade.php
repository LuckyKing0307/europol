@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush
@section('title', $page->title ? $page->title : 'Europol | Ламинат Паркет Ковролин')

<section class="blog max-w-screen-2xl mx-auto">
    <div class="container">
        <div class="blog__container">
            <h1 class="blog__title">{{ $page->title }}</h1>

            @if ($page->og_image)
                <img src="{{ asset('storage/' . $page->og_image) }}" class="blog__img" alt="{{ $page->title }}" />
            @endif

            <div class="blog__content">
                <div class="text-sm">{!! $page->content !!}</div>
            @if (!empty(json_decode($page->content_blocks,1)))
                    @foreach (json_decode($page->content_blocks,1) as $block)
                        <div class="flex md:flex-row gap-6 my-10 {{ $block['image_position'] === 'left' ? 'md:flex-row-reverse' : '' }}">
                            @if (!empty($block['image']))
                                <div class="w-1/2 blog_blog">
                                    <img src="{{ asset('storage/' . $block['image']) }}"
                                         alt="{{ $block['title'] ?? '' }}"
                                         class="w-full rounded-xl object-cover" loading="lazy">
                                </div>
                            @endif

                            <div class="w-1/2 blog_blog">
                                @if (!empty($block['title']))
                                    <h2 class="text-xl font-semibold mb-2">{{ $block['title'] }}</h2>
                                @endif
                                <div class="text-sm">{!! $block['text'] !!}</div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <span class="blog__date">
                    {{ \Carbon\Carbon::parse($page->updated_at)->translatedFormat('d F Y') }}
                </span>

                {{-- Здесь можно вставить ссылку на следующую статью, если надо --}}
                @if ($nextPost)
                    <a href="{{ route('blog.view', ['slug' => $nextPost->slug]) }}" class="blog__next">
                        Следующая статья: {{ $nextPost->title }}
                    </a>
                @endif
            </div>
        </div>
        @if(count($relatedPosts))
            <h2 class="blog__title">Читайте также</h2>
        @endif

        <ul class="blogs__list blogs-list">
            @foreach ($relatedPosts as $related)
                <li class="blogs-list__item">
                    <a href="{{ route('blog.view', ['slug' => $related->slug]) }}">
                        <article class="blogs-list__article blogs-article">
                            <img src="{{ asset('storage/' . $related->og_image) }}" alt="{{ $related->title }}" />
                            <div class="blogs-article__txt">
                                <h2 class="blogs-article__title">{{ $related->title }}</h2>
                                <p class="blogs-article__descr">
                                    {{ \Illuminate\Support\Str::limit($related->meta_description, 120) }}
                                </p>
                                <span class="blogs-article__date">
                            {{ \Carbon\Carbon::parse($related->updated_at)->translatedFormat('d F Y') }}
                        </span>
                            </div>
                        </article>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
</section>
