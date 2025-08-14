<section class="section pre-loader" fetchpriority="high" loading="eager" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000" style="background: none;">
    <div class="video-overlay"></div>
    <x-collection-sale />
</section>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const catalog = document.querySelector(".pre-loader");
            if (!catalog) return;

            const video = document.createElement("video");
            video.poster = "{{ asset('img/pre-view.webp') }}"; // моментально загружаемый постер
            video.autoplay = true;
            video.muted = true;
            video.loop = true;
            video.playsInline = true;
            video.preload = "none"; // не загружаем видео до вызова
            video.classList.add("bg-video");

            catalog.prepend(video);

            // подгон высоты
            const header = document.querySelector('header');
            if (header) {
                const headerHeight = header.offsetHeight;
                catalog.style.minHeight = `calc(100vh - ${headerHeight}px)`;
            }

            // Ленивая загрузка видео
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    // создаём источники для webm и mp4
                    const sourceWebm = document.createElement("source");
                    sourceWebm.src = "{{ asset('img/pre-view.webp') }}";
                    sourceWebm.type = "video/webm";

                    const sourceMp4 = document.createElement("source");
                    sourceMp4.src = "{{ asset('img/pre-view-test.mp4') }}";
                    sourceMp4.type = "video/mp4";

                    video.appendChild(sourceWebm);
                    video.appendChild(sourceMp4);

                    video.load();
                    video.play();
                    observer.disconnect();
                }
            }, { rootMargin: "200px" }); // начинаем подгружать чуть раньше

            observer.observe(catalog);
        });
    </script>
@endpush
