<div class="mx-auto max-w-screen-2xl content_block">
    <div class="block_title">{{__('popular.title')}}</div>
    <div class="block_content">
        <div class="swiper-popular swiper-desktop">
            <div class="swiper-wrapper">
                <div class="swiper-slide popular-wrapper">
                    @foreach($popular as $pop)
                        <div class="popular">
                            <img src="{{ $pop->getFirstMediaUrl('image') }}" alt="{{ $pop->title }}" class="w-full h-64 object-cover">
                            <div class="popular_text">{{ $pop->title }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="swiper-popular swiper-mobile">
            <div class="swiper-wrapper">
                <!-- Каждый отдельный -->
                @foreach($popular as $pop)
                    <div class="swiper-slide popular_slide">
                        <img src="{{ $pop->getFirstMediaUrl('image') }}" alt="{{ $pop->title }}">
                        <div class="popular_text">{{ $pop->title }}</div>
                    </div>
                @endforeach
            </div>
    </div>
</div>
<script>
    document.addEventListener('swiper-popular', function () {
        new Swiper('.swiper-popular', {
            slidesPerView: 1, // сколько,
            spaceBetween: 30, // расстояние между карточками
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
