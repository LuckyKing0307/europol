@push('page-styles')
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush

<section class="works">
    <div class="works__container">
        <h1 class="works__title">Наши реализованные проекты</h1>

        <div class="projects-grid">
            @foreach($projects as $project)
                @php
                    $images = is_array($project->images) ? $project->images : [];
                    $main   = $images[0] ?? null;
                    $others = array_slice($images, 1);
                @endphp

                <div class="project-card" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                        <div class="projects_photos">
                            @if($main)
                                <div class="project-main">
                                    <img src="{{ asset('storage/'.$main) }}" alt="{{ $project->title }}">
                                </div>
                            @endif

                            @if(count($others))
                                <div class="project-thumbs">
                                    @foreach($others as $img)
                                        <img src="{{ asset('storage/'.$img) }}" alt="{{ $project->title }}">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="project-title">{{ $project->title }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@push('scripts')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                easing: 'ease-out-quart', // кривая
                once: true,     // анимировать только один раз
                offset: 100,     // смещение триггера
            });
        });

        // Для Livewire — повторная инициализация после подгрузки
        window.Livewire?.hook?.('message.processed', () => {
            AOS.refresh();
        });
    </script>
@endpush

