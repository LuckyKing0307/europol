<div class="mx-auto max-w-screen-2xl content_block">
    <div class="block_title">Популярные товары</div>
    <div class="block_content">
        <div class="sm:w-full lg:w-1/2 flex justify-center">
            <div class="w-full max-w-md hidden_type">
                <!-- Обёртка Swiper -->
                <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                        @foreach($productsData as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar mt-4"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('swiper-initialize', function () {
        console.log('asd')
        setTimeout(() => {
            if (document.querySelector('.product-slider')) {
                new Swiper('.product-slider', {
                    slidesPerView: 4.5,
                    freeMode: true,
                    grabCursor: true,
                    spaceBetween: 20,
                    scrollbar: {
                        el: '.swiper-scrollbar',
                        draggable: true, // полоску можно перетаскивать мышкой
                    },
                    slidesOffsetAfter: 150,
                    breakpoints: {
                        320: {slidesPerView: 1, slidesOffsetAfter: 50},
                        640: {slidesPerView: 2, slidesOffsetAfter: 100},
                        1024: {slidesPerView: 4.5, slidesOffsetAfter: 150}
                    }
                });
            }
        }, 100);
    });
</script>

