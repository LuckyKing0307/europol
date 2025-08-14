<section class="section pre-loader" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000" style="background: none;">
    <div class="video-overlay"></div>
    <x-collection-sale />
</section>


@push('scripts')
    <script>
        const catalog = document.querySelector(".pre-loader");

        const video = document.createElement("video");
        video.src = "{{ asset('img/pre-view.mp4') }}";
        video.poster = "{{ asset('img/pre-view.png') }}";
        video.autoplay = true;
        video.muted = true;
        video.loop = true;
        video.playsInline = true; // для iOS
        video.classList.add("bg-video");

        catalog.prepend(video);
        const header = document.querySelector('header');

        if (header) {
            const headerHeight = header.offsetHeight;
            catalog.style.minHeight = `calc(100vh - ${headerHeight}px)`;
        }
    </script>
@endpush
