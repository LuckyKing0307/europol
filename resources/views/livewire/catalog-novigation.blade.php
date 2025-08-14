<div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
    <div class="catalog_lists">
        <div class="sm:w-full lg:w-1/2 flex justify-center">
            <div class="w-full max-w-md hidden_type">
                <!-- Обёртка Swiper -->
                <div class="swiper catalog-slider">
                    <div class="swiper-wrapper">
                                @foreach ($this->collections as $collection)
                                    @if ($collection->id >= 53)
                                        @php
                                            $img = $collection->getFirstMediaUrl('images');
                                            $isFirst = $loop->first;
                                        @endphp

                                        <a class="swiper-slide catalog_list" style="padding: 0;" href="{{ route('collection.view', $collection->defaultUrl->slug) }}">
                                            <img
                                                src="{{ $img }}"
                                                alt="{{ $collection->translateAttribute('name') }}"
                                                @if($isFirst)
                                                    fetchpriority="high"
                                                    loading="eager"
                                                @else
                                                    loading="lazy"
                                                @endif
                                                decoding="async"
                                                style="width:100%;height:auto;aspect-ratio: 4/4;object-fit:cover;"
                                            >
                                        </a>
                                    @endif
                                @endforeach
{{--                        <a class="swiper-slide catalog_list"--}}
{{--                           href="{{ route('collection.view.all') }}">--}}
{{--                            <img src="{{asset('img/all.svg')}}"--}}
{{--                                 alt="{{ $collection->translate('name') }}">--}}
{{--                            <p class="text-sm font-medium">--}}
{{--                                All--}}
{{--                            </p>--}}
{{--                        </a>--}}
                    </div>
                    <div class="swiper-scrollbar mt-4"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('swiper-catalogs', function () {
        new Swiper('.catalog-slider', {
            slidesPerView: 7,
            freeMode: true,
            grabCursor: true,

            spaceBetween: 20,
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true, // полоску можно перетаскивать мышкой
            },
            slidesOffsetAfter: 150,
            breakpoints: {
                320: {slidesPerView: 2.5, slidesOffsetAfter: 50},
                640: {slidesPerView: 3.5, slidesOffsetAfter: 100},
                1024: {slidesPerView: 7, slidesOffsetAfter: 150}
            }
        });
    });
</script>
