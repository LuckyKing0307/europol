<div class="before-after-block" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
    <div class="mx-auto max-w-screen-xl content_block before-after-block_title">
        <div class="block_title"><h2>Магия преображения полов</h2></div>
        <div class="block_text">Посмотрите, как напольные покрытия меняют восприятие пространства</div>
        <div class="block_content">
            <div id="floor-compare"
                 class="beer-slider rounded-3xl overflow-hidden"
                 data-beer-label="После" style="">
                <img loading="lazy" src="{{asset('img/before.webp')}}" alt="Пол после ремонта">

                <div class="beer-reveal" data-beer-label="До">
                    <img loading="lazy" src="{{asset('img/after.webp')}}" alt="Пол до ремонта">
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>

        document.addEventListener('swiper-catalogs', function () {
            new BeerSlider(document.getElementById('floor-compare'), { start: 75 });
        });
    </script>

@endpush

