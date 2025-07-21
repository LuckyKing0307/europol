<div class="mx-auto max-w-screen-2xl content_block" wire:ignore>
    <div class="block_title">Популярные бренды</div>
    <div class="block_content brand_content">
        <div class="sm:w-full lg:w-1/2 flex justify-center">
            <div class="w-full max-w-md hidden_type">
                <!-- Обёртка Swiper -->
                <div class="swiper brand-slider" style="padding-bottom: 40px;" >
                    <div class="swiper-wrapper">
                            @foreach($brands as $brand)
                            <a href="{{ url()->current() }}?brand={{ $brand->id }}" class="flex swiper-slide brand_list items-center justify-center p-4 bg-white rounded-lg shadow
                  hover:shadow-md transition">
                                @if ($brand->thumbnail)
                                    <img src="{{ $brand->thumbnail->getUrl('medium') }}" alt="{{ $brand->name }}"
                                         class="max-h-16 object-contain m-auto">
                                @else
                                    <p class="brand_text" style="color: #1D1D1D;">{{ $brand->name }}</p>
                                @endif
                            </a>
                            @endforeach
                    </div>
                    <div class="swiper-scrollbar mt-4"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        if (document.querySelector('.brand-slider')) {
            new Swiper('.brand-slider', {
                slidesPerView: 6,
                freeMode: true,
                grabCursor: true,
                spaceBetween: 20,
                slidesOffsetAfter: 150,
                breakpoints: {
                    320: {slidesPerView: 2, slidesOffsetAfter: 50},
                    640: {slidesPerView: 3, slidesOffsetAfter: 100},
                    1024: {slidesPerView: 6, slidesOffsetAfter: 150}
                }
            });
        }
    </script>
@endpush
