<div class="before-after-block">
    <div class="mx-auto max-w-screen-2xl content_block" style="margin-top: 0;">
        <div class="block_title">Магия преображения полов</div>
        <div class="block_text">Посмотрите, как напольные покрытия меняют восприятие пространства</div>
        <div class="block_content">
            <div id="floor-compare"
                 class="beer-slider rounded-3xl overflow-hidden"
                 data-beer-label="После" style="border-radius: 40px; overflow: hidden">
                <img src="{{asset('img/before.png')}}" alt="Пол после ремонта">

                <div class="beer-reveal" data-beer-label="До">
                    <img src="{{asset('img/after.png')}}" alt="Пол до ремонта">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/beerslider/dist/BeerSlider.js"></script>
<script>
    new BeerSlider(document.getElementById('floor-compare'), { start: 75 });
</script>

