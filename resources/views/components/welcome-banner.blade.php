<section class="section pre-loader" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000" style="background: none;">
    <div class="video-overlay"></div>
</section>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const catalog = document.querySelector(".pre-loader");

            const video = document.createElement("video");
            video.src = "{{ asset('img/pre-view.mp4') }}";
            video.autoplay = true;
            video.muted = true;
            video.loop = true;
            video.playsInline = true; // для iOS
            video.classList.add("bg-video");

            catalog.prepend(video);
            const header = document.querySelector('header');

            if (header && section) {
                const headerHeight = header.offsetHeight;
                catalog.style.minHeight = `calc(100vh - ${headerHeight}px)`;
            }
        });
    </script>
@endpush
