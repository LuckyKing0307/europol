<header class="relative border-b border-gray-100">
    <div class="sub-header ">
        <div class="max-w-screen-2xl mx-auto flex justify-end">
            <div class="flex flex-1 items-center justify-between px-4 max-w-screen-xl ">
                <div class="flex header-info">
                    <div class="location"><span><img src="{{asset('img/location.svg')}}" alt=""></span>Ташкент</div>
                    <a href="tel:+998723049843" class="shops">Магазины</a>
                </div>
                <div class="lang flex header-info">
                    {{--                @livewire('language-switcher')--}}
                    <div class="working-time">с 9:00 до 20:00 ежедневно</div>
                    <a href="tel:+998901234567"><span><img src="{{asset('img/phone.svg')}}" alt=""></span>+998 90 123 45 67</a>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-2xl mx-auto flex justify-end">
        <div class="flex items-center" style="max-width: 15%;">
            <a class="flex items-center flex-shrink-0 logo_item"  style="max-width: 100%;"
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
                        class="grid flex-shrink-0 w-16 h-16 border-l border-gray-100 lg:hidden">
                    <span class="sr-only">{{ __('header.language') }}</span>
                    <span class="place-self-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </span>
                </button>

                <div x-cloak
                     x-transition
                     x-show="mobileMenu"
                     class="absolute top-auto z-50 w-screen p-4 w-full">
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
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <ul x-on:click.away="mobileMenu = false"
                            class="p-6 space-y-4 bg-white border border-gray-100 shadow-xl">
                            <x-header.search class="max-w-sm mr-4"/>
                            @foreach ($this->collections as $root)
                                <livewire:components.collection-node :node="$root" :level="0" :key="'node-'.$root->id" />
                            @endforeach
                        </ul>

                        <div class="sub_section_menu">
                            <div class="">
                                {{ __('header.phone') }}: <br><a href="tel:+998723049843">+998 (72) 304-98-43</a>
                            </div>
                            <div class="lang flex">
                                @livewire('language-switcher')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <a class="flex items-center flex-shrink-0 logo_item mob_logo"  style="max-width: 100%;"
              href="{{ url('/') }}"
              wire:navigate
           >
               <span class="sr-only">Home</span>

               <x-brand.logo class="w-auto h-6 text-indigo-600"/>
           </a>
            <div class="flex items-center justify-center  ml-2 lg:justify-center catalogs_wrapper" >
                <div class="catalogs">
                    <div class="btns active menu_btn"  onclick="openMenu()"><button class="menu_btn">{{ __('header.catalog') }}</button></div>
                    <div class="menu_block hidden">
                        <ul class="p-6 space-y-4 bg-white border border-gray-100 shadow-xl openMenu">
                            @foreach ($this->collections as $root)
                                <livewire:components.collection-node :node="$root" :level="0" :key="'node-'.$root->id" />
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

    <div class="max-w-screen-2xl mx-auto flex justify-end main_pc_menu">
        <div class="flex flex-1 items-center justify-between h-16 px-4 max-w-screen-xl">
            <nav class="hidden lg:gap-4 lg:flex">
                {{--            @foreach ($this->collections as $collection)--}}
                {{--                <a class="text-sm font-medium transition hover:opacity-75"--}}
                {{--                   href="{{ route('collection.view', $collection->defaultUrl->slug) }}"--}}
                {{--                   wire:navigate--}}
                {{--                >--}}
                {{--                    {{ $collection->translateAttribute('name') }}--}}
                {{--                </a>--}}
                {{--            @endforeach--}}
                <a href="#" class="text-sm font-medium transition hover:opacity-75">Главная</a>
                <a href="https://uzbekistan360.uz/ru/location/europolmke" class="text-sm font-medium transition hover:opacity-75" target="_blank">3D тур</a>
                <a href="{{route('about.view')}}" class="text-sm font-medium transition hover:opacity-75">О компании</a>
                <a href="{{route('work.view')}}" class="text-sm font-medium transition hover:opacity-75">Проекты</a>
                <a href="{{route('blogs.view')}}" class="text-sm font-medium transition hover:opacity-75">Блог</a>
{{--                <a href="{{route('about.view')}}" class="text-sm font-medium transition hover:opacity-75">Для дизайнеров</a>--}}
                <a href="{{route('warranty.view')}}" class="text-sm font-medium transition hover:opacity-75">Гарантия</a>
{{--                <a href="{{route('work.view')}}" class="text-sm font-medium transition hover:opacity-75">Вакансии</a>--}}
{{--                <a href="{{route('about.view')}}" class="text-sm font-medium transition hover:opacity-75">Сотруднечество</a>--}}
            </nav>
        </div>
    </div>
    <script>
        const catalog = document.querySelector('.menu_block');
        function toggleCatalog() {
            catalog.classList.toggle('hidden');
            catalog.classList.toggle('block');
        }

        function openMenu(){
            catalog.classList.remove('hidden');
            catalog.classList.add('block');
        }
        document.addEventListener('click', (e) => {
            if (!e.target.classList.contains('menu_block') && !e.target.classList.contains('menu_btn')) {
                catalog.classList.remove('block');
                catalog.classList.add('hidden');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                toggleCatalog();
            }
        });
    </script>
</header>
