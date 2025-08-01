<header class="relative border-b border-gray-100" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000" style="position: relative; z-index: 100;">
    <div class="sub-header ">
        <div class="max-w-screen-xl mx-auto flex justify-end">
            <div class="flex" style="min-width: 10%;"></div>
            <div class="flex flex-1 items-center justify-between px-4 max-w-screen-xl ">
                <div class="lang flex header-info">
                    <div class="working-time"><img src="{{asset('img/clock.svg')}}" alt=""
                                                   style="margin-left: 10px;margin-right: 5px; width: 18px;">с 9:00 до 22:00 ежедневно</div>
                    <a href="tel:+998555100102" class="ml-2"><span><img src="{{asset('img/phone.svg')}}" alt=""
                                                                        style="margin-left: 10px;margin-right: 5px;"></span>+998 55-510-01-02</a>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-xl mx-auto flex justify-end">
        <div class="flex items-center" style="max-width: 10%;">
            <a class="flex items-center flex-shrink-0 logo_item" style="max-width: 100%;"
               href="{{ url('/') }}"
               wire:navigate
            >
                <span class="sr-only">Home</span>

                <x-brand.logo class="w-auto h-6 text-indigo-600"/>
            </a>
        </div>
        <div class="flex flex-1 items-center justify-between px-4 max-w-screen-xl menu_bar">
            <div x-data="{ mobileMenu: false }">
                <button x-on:click="mobileMenu = !mobileMenu"
                        class="grid flex-shrink-0 w-16 h-16 border-gray-100 lg:hidden">
                    <span class="sr-only">{{ __('header.language') }}</span>
                    <span class="place-self-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="#fff"
                         viewBox="0 0 24 24"
                         stroke="#fff">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              fill="#fff"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </span>
                </button>

                <div x-cloak
                     x-transition
                     x-show="mobileMenu"
                     class="absolute top-auto z-50 w-screen p-4 w-full ">
                    <div class="bg-white relative">
                        <button class="absolute text-gray-500 transition-transform top-3 right-3 hover:scale-110"
                                type="button"
                                aria-label="Close"
                                x-on:click="mobileMenu = false">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <ul x-on:click.away="mobileMenu = false" class="p-6 space-y-4 border border-gray-100 shadow-xl mobmenue">
                            <x-header.search class="max-w-sm mr-4"/>
                            @foreach ($this->collections as $root)
                                @if($root->id>=53)
                                    <livewire:components.collection-node :node="$root" :level="0" :key="'node-'.$root->id"/>
                                @endif
                            @endforeach
                        </ul>

                        <div class="sub_section_menu">
                            <div class="">
                                <div class="flex header-info">
                                    <div class="location"><span><img src="{{asset('img/location.svg')}}"
                                                                     alt=""></span><span id="tashkent" class="ml-2">Ташкент</span>
                                    </div>
                                    <a href="{{route('maps')}}" class="shops">Магазины</a>
                                </div>
                                {{ __('header.phone') }}: <br><a href="tel:+998723049843">+998 (55) 510-01-02</a>
                            </div>
                            <div class="lang flex">
                                @livewire('language-switcher')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="flex items-center flex-shrink-0 logo_item mob_logo" style="max-width: 100%;"
               href="{{ url('/') }}"
               wire:navigate
            >
                <span class="sr-only">Home</span>

                <x-brand.logo class="w-auto h-6 text-indigo-600"/>
            </a>
            <div class="flex items-center justify-center lg:justify-center catalogs_wrapper">
                <div class="catalogs">
                    <div class="btns active menu_btn" onclick="openMenu()">
                        <button class="menu_btn">{{ __('header.catalog') }}</button>
                    </div>
                    <div class="menu_block hidden">
                        <ul class="p-6 space-y-4 bg-white border border-gray-100 shadow-xl openMenu">
                            @foreach ($this->collections as $root)
                                @if($root->id>=53)
                                    <livewire:components.collection-node :node="$root" :level="0"
                                                                         :key="'node-'.$root->id"/>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-between flex-1 ml-4 lg:justify-end search_input_wrapper">
                <x-header.search class="max-w-sm mr-4"/>
            </div>
            <div class="flex items-center justify-between  lg:justify-end">
                <div class="flex items-center lg:mr-0">
                    @livewire('components.cart')
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto flex justify-end main_pc_menu">
        <div class="flex" style="min-width: 10%;"></div>
        <div class="flex flex-1 items-center justify-between h-16 px-4 max-w-screen-xl">
            <nav class="hidden lg:gap-4 lg:flex nav_data">
                <a href="{{route('home_page')}}" class="text-sm font-medium transition hover:opacity-75">Главная</a>
                <a href="https://uzbekistan360.uz/ru/location/europolmke"
                   class="text-sm font-medium transition hover:opacity-75" target="_blank">3D тур</a>
                <a href="{{route('about.view')}}" class="text-sm font-medium transition hover:opacity-75">О компании</a>
                <a href="{{route('work.view')}}" class="text-sm font-medium transition hover:opacity-75">Проекты</a>
                <a href="{{route('blogs.view')}}" class="text-sm font-medium transition hover:opacity-75">Блог</a>
                <a href="{{route('warranty.view')}}"
                   class="text-sm font-medium transition hover:opacity-75">Гарантия</a>
                <a href="{{route('maps')}}" class="text-sm font-medium transition hover:opacity-75">Магазины</a>
            </nav>
        </div>
    </div>
    @push('scripts')
        <script>
            if (!window._catalog_script_initialized) {
                window._catalog_script_initialized = true;
                let catalog_sub_menu = document.querySelector('.menu_block');
                function toggleCatalog() {
                    catalog_sub_menu.classList.toggle('hidden');
                    catalog_sub_menu.classList.toggle('block');
                }
                function openMenu() {
                    catalog_sub_menu.classList.remove('hidden');
                    catalog_sub_menu.classList.add('block');
                }
                document.addEventListener('click', (e) => {
                    if (!e.target.classList.contains('menu_block') && !e.target.classList.contains('menu_btn')) {
                        catalog_sub_menu.classList.remove('block');
                        catalog_sub_menu.classList.add('hidden');
                    }
                });
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        toggleCatalog();
                    }
                });
                fetch('https://ipapi.co/json/')
                    .then(r => r.json())
                    .then(data => {
                        const location =
                            `${data.city}, ${data.country_name}`;
                        document.querySelector('#tashkent').innerText = location;
                    })
                    .catch(() => console.log('не смогли найти'));
            }
        </script>
    @endpush
</header>
