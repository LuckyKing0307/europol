<div class="filters p-6 max-w-screen-2xl px-8 py-4 mx-auto sm:px-2 lg:px-4">
    <!-- Кнопка для открытия фильтра -->
    <button id="open-filter" class="open-btn" onclick="openFilter()">
        <span><img src="{{ asset('img/filter.svg') }}" alt=""></span>{{ __('filters.all') }}
    </button>

    <!-- Черный фон для затемнения -->
    <div id="overlay" class="bg_black" style="display: none;"></div>

    <!-- Модальное окно фильтра -->
    <div id="filter-modal" class="p-6 bg-white max-w-md h-full overflow-y-auto fixed right-0 top-0 w-1/4 zet" style="display: none;">
        <div class="filter-header">
            <h2>{{ __('filters.filter') }}</h2>
            <button id="close-filter" class="close-btn" onclick="closedFilter('zet')">✕</button>
        </div>
        <hr>
        <div class="mb-6">
            <h3 class="font-semibold mb-2 price_text">{{ __('filters.price') }}</h3>
            <div class="flex justify-between mb-4 text-sm text-gray-600">
                <div class="flex items-center gap-2 price_filter_input">
                    <span>{{ __('filters.from') }}</span>
                    <input type="text" id="minPriceDisplay" readonly class="text-center border border-gray-300"/>
                </div>
                <div class="flex items-center gap-2 price_filter_input">
                    <span>{{ __('filters.to') }}</span>
                    <input type="text" id="maxPriceDisplay" readonly class="text-center border border-gray-300"/>
                </div>
            </div>

            <div wire:ignore id="price-range" class="w-full"></div>
        </div>

        <!-- Фильтрация по опциям -->
        @foreach ($productOptions as $key => $values)
            @if($key !== 'Цена, UZS' && $key !== 'В наличии')
                <div class="mb-4 option_list border-b pb-2" x-data="{ open: false }">
                    <button
                        class="w-full flex justify-between items-center text-left text-lg font-semibold mb-2 focus:outline-none"
                        @click="open = !open"
                    >
                        <span>{{ $key }}</span>
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul class="space-y-1 mt-2" x-show="open" x-transition>
                        @foreach ($values as $value)
                            @if($value !== '')
                                <li>
                                    <label class="flex items-center gap-2 check_box">
                                        {{ $value }}
                                        <input type="checkbox" wire:model.live="selectedOptions" value="{{ $value }}">
                                        <span class="flex items-center gap-2 switch">
                                    <span class="slider"></span>
                                </span>
                                    </label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach

        <!-- Кнопка для применения фильтров -->
        <button wire:click="applyFilters" class="mt-6 w-full text-white py-3 rounded hover:bg-indigo-700 filter_btn">
            {{ __('filters.apply') }}
        </button>
    </div>
</div>

<!-- JavaScript для управления открытием и закрытием -->
<script defer>
    // Открытие фильтра
    const filterModal = document.getElementById('filter-modal');
    let overlay = document.getElementById('overlay');
    function openFilter() {
        filterModal.style.display = 'block';
        overlay.style.display = 'block';
    }

    function closedFilter() {
        filterModal.style.display = 'none';
        overlay.style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('price-range');
        const minPriceInput = document.getElementById('minPriceDisplay');
        const maxPriceInput = document.getElementById('maxPriceDisplay');

        // Инициализация ползунка
        const initSlider = () => {
            noUiSlider.create(slider, {
                start: [0, 10000000], // Начальные значения
                connect: true, // Связаны ли ползунки
                range: {
                    min: 0, // Минимальное значение
                    max: 10000000 // Максимальное значение
                },
                step: 1, // Шаг ползунка
                format: {
                    to: v => Math.round(v / 100), // Делим сразу на 100 при отображении
                    from: v => Number(v) // При преобразовании обратно умножаем на 100
                }
            });

            slider.noUiSlider.on('update', function (values) {
                minPriceInput.value = values[0];
                maxPriceInput.value = values[1];
            });
        };

        initSlider()
    });
</script>
