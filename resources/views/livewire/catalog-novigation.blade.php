<div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
    <div class="catalog_lists">
        <div class="sm:w-full lg:w-1/2 flex justify-center">
            <div class="w-full max-w-md hidden_type">
                <!-- Обёртка Swiper -->
                <div class="swiper catalog-slider">
                    <div class="swiper-wrapper">
                        @foreach ($this->collections as $collection)
                            <a class="swiper-slide catalog_list"  href="{{ route('collection.view', $collection->defaultUrl->slug) }}">
                                <p class="text-sm font-medium">
                                    {{ $collection->translateAttribute('name') }}
                                </p>
                                <img src="{{ $collection->getFirstMediaUrl('images') }}"
                                     alt="{{ $collection->translate('name') }}">
                            </a>
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
