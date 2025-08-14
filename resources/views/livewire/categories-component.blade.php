<div class="mx-auto max-w-screen-xl content_block" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
    <div class="block_title">Категории товаров</div>
    <div class="block_content">
        <div class="sm:w-full lg:w-1/2 flex justify-center">
            <div class="w-full max-w-md hidden_type">
                <!-- Обёртка Swiper -->
                <div class="swiper category-slider" style="padding-bottom: 30px; overflow: visible;">
                    <div class="swiper-wrapper">
                        @foreach ($this->collections as $root)
                            @if ($root->id >= 53)
                                @php
                                    $img = $root->img;
                                    if($root->id==53){
                                        $isFirst = $root;
                                    }
                                @endphp
                                <a class="swiper-slide category_list" style="background: none; border:none;"
                                   href="{{ route('collection.view', $root->defaultUrl->slug) }}">
                                    <img src="{{$root->getFirstMediaUrl('images')}}"
                                         alt="{{$root->translateAttribute('name')}}"

                                         @if($isFirst)
                                             fetchpriority="high"
                                         loading="eager"
                                         @else
                                             loading="lazy"
                                         @endif
                                         decoding="async"
                                    >
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="prices">--}}
    {{--        <div class="price">--}}
    {{--            <div class="price_content">--}}
    {{--                <h4 class="price_title">17 000+</h4>--}}
    {{--                <p class="price_text">счастливых клиентов по всему Узбекистану</p>--}}
    {{--            </div>--}}
    {{--            <div class="price_content">--}}
    {{--                <h4 class="price_title">110+</h4>--}}
    {{--                <p class="price_text">Сотрудников производства</p>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="price">--}}
    {{--            <div class="price_content">--}}
    {{--                <h4 class="price_title">1100m+</h4>--}}
    {{--                <p class="price_text">Производственная площадь</p>--}}
    {{--            </div>--}}
    {{--            <div class="price_content">--}}
    {{--                <h4 class="price_title">15+</h4>--}}
    {{--                <p class="price_text">Годы рабочего стажа</p>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="grade">--}}
    {{--            <img src="{{asset('img/cuboc.svg')}}" alt="Кубок">--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.Swiper) {
                new Swiper('.category-slider', {
                    slidesPerView: 7,
                    freeMode: true,
                    grabCursor: true,
                    spaceBetween: 20,
                    breakpoints: {
                        320: {slidesPerView: 2.7, slidesOffsetAfter: 50},
                        640: {slidesPerView: 3, slidesOffsetAfter: 100},
                        1024: {slidesPerView: 7, slidesOffsetAfter: 150},
                    }
                });
            }
        });
    </script>
@endpush

