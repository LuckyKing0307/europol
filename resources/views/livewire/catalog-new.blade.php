<div class="mx-auto max-w-screen-2xl content_block">
    <div class="block_title">{{ __('catalog.new_title') }}</div>
    <div class="block_text">{{ __('catalog.new_text') }}</div>
    <div class="block_content">
        <div class="sm:w-full lg:w-1/2 flex justify-center">
            <div class="w-full max-w-md hidden_type">
                <!-- Обёртка Swiper -->
                <div class="swiper new-slider">
                    <div class="swiper-wrapper">
                        @foreach($productsData as $product)
                            <div class="swiper-slide product">
                                <div class="p-4 rounded-lg text-center">
                                    <a href="{{ route('product.view', $product['url']) }}">
                                        @if ($product['img'])
                                            <img class="mx-auto mb-4"
                                                 src="{{ $product['img']->getUrl('medium') }}"/>
                                        @endif
                                    </a>
                                </div>
                                <div class="flex p-4 justify-between">
                                    <div class="price">
                                        <div class="text-sm font-medium mb-2 product_title"><a href="{{ route('product.view', $product['url']) }}">{{$product['name']}}</a></div>
                                        <div class="flex items-center line-through text-gray-400 text-xs price_main">
                                        </div>
                                        <div class="text-red-600 font-bold text-lg"><span class="sale_price">{{$product['base_price']}}</span></div>
                                    </div>
                                    <div class="action">
                                        <div class="like">
                                            <img src="{{asset('img/like.svg')}}" alt="Лайк">
                                        </div>
                                        <div class="basket">
                                            <img src="{{asset('img/basket2.svg')}}" alt="Корзина">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar mt-4"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('swiper-new', function () {
        new Swiper('.new-slider', {
            slidesPerView: 4.5,
            spaceBetween: 24,
            freeMode: true,
            grabCursor: true,
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true, // полоску можно перетаскивать мышкой
            },
            slidesOffsetAfter: 150,
            breakpoints: {
                320: { slidesPerView: 1.2,slidesOffsetAfter:50 },
                640: { slidesPerView: 2,slidesOffsetAfter:100 },
                1024: { slidesPerView: 4.5,slidesOffsetAfter:150 }
            }
        });
    });
</script>

