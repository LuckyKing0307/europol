<section>
    <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between grid-cols-1 gap-8 md:grid-cols-2 product_elements">
            <div class="flex grid-cols-2 gap-4 md:grid-cols-1 information_block">
                <div class="images_block">
                    @if ($this->image)
                        <div class="aspect-w-1 aspect-h-1">
                            <img class="object-cover main_img"
                                 src="{{ $this->image->getUrl('large') }}"
                                 alt="{{ $this->product->translateAttribute('name') }}"/>
                        </div>
                    @else
                        <div class="aspect-w-1 aspect-h-1">
                            <img class="object-cover main_img"
                                 src="{{asset('img/empty.png') }}"
                                 alt="empty"/>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                        @foreach ($this->images as $image)
                            <div class="aspect-w-1 aspect-h-1"
                                 wire:key="image_{{ $image->id }}">
                                <img loading="lazy"
                                     class="object-cover "
                                     src="{{ $image->getUrl('small') }}"
                                     alt="{{ $this->product->translateAttribute('name') }}"/>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="boy_class">
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $this->variant->sku }}
                    </p>
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold">
                            {{ $this->product->translateAttribute('name') }}
                        </h1>
                    </div>
                    <div class="product_data-card">
                        <div class="product_data-header">
                            <div>
                                <span class="product_data-price-perm2" id="price-per-m2"><x-product-price
                                        :variant="$this->variant"/></span>
                            </div>
                        </div>
                        <div class="product_data-units">
                            <span class="product_data-unit-label">за упаковку</span>
                        </div>
                        <hr class="product_data-divider"/>
                        <div class="product_data-switcher">
                            <button class="product_data-switch product_data-switch--active">за м<sup>2</sup></button>
                            <span class="product_data-switch-text">шт</span>
                            <span class="product_data-switch-text">упак</span>
                            <span class="product_data-pack-info"
                                  id="pack-info">1.76 м<sup>2</sup> = 11 шт = 1 упак</span>
                        </div>
                        <div class="product_data-qty">
                            <button class="product_data-btn product_data-btn--minus" id="minus-btn">−</button>
                            <div class="product_data-qty-value" id="qty-value">
                                1.76 м<sup>2</sup>
                            </div>
                            <button class="product_data-btn product_data-btn--plus" id="plus-btn">+</button>
                        </div>


                        <form class="mt-4">
                            <div class="space-y-4">
                                @foreach ($this->productOptions as $option)
                                    <fieldset>
                                        <legend class="text-xs font-medium text-gray-700">
                                            {{ $option['option']->translate('name') }}
                                        </legend>

                                        <div class="flex flex-wrap gap-2 mt-2 text-xs tracking-wide uppercase"
                                             x-data="{
                                         selectedOption: @entangle('selectedOptionValues').live,
                                         selectedValues: [],
                                     }"
                                             x-init="selectedValues = Object.values(selectedOption);
                                     $watch('selectedOption', value =>
                                         selectedValues = Object.values(selectedOption)
                                     )">
                                            @foreach ($option['values'] as $value)
                                                <button
                                                    class="px-6 py-4 font-medium border rounded-lg focus:outline-none"
                                                    type="button"
                                                    wire:click="
                                                $set('selectedOptionValues.{{ $option['option']->id }}', {{ $value->id }})
                                            "
                                                    :class="{
                                                    'text-white main_color': selectedValues
                                                        .includes({{ $value->id }}),
                                                    'hover:bg-gray-100': !selectedValues.includes({{ $value->id }})
                                                }">
                                                    {{ $value->translate('name') }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                @endforeach
                            </div>
                        </form>
                        <livewire:components.add-to-cart :purchasable="$this->variant"
                                                         :wire:key="$this->variant->id">

                            <div class="product_data-total-label">Итого</div>
                            <div class="product_data-total" id="total-price">
                                <x-product-price :variant="$this->variant"/>
                                сум
                            </div>
                            <div class="product_data-shipping">
                                <span class="product_data-shipping-icon">🚚</span>
                                Курьером в <span class="product_data-shipping-city">Ташкенте</span> ·
                                <span class="product_data-shipping-price">1 190 сум</span> · Послезавтра
                            </div>
                            <div class="product_data-return">
                                <span class="product_data-return-icon">↺</span>
                                Можно вернуть в течение <b>7 дней</b> после покупки
                            </div>
                    </div>
                    <div class="product-specs">
                        <h2 class="product-specs__title">О товаре</h2>
                        @if(count($this->characteristics)!=0)
                            <div class="product-specs__table">
                                @foreach ($this->characteristics as $text)
                                    <div class="product-specs__row">
                                        <div class="product-specs__cell">{{$text->key}}</div>
                                        <div class="product-specs__cell">{{$text->value}}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="max-w-screen-2xl">
                <div class="product-specs">
                    <h2 class="product-specs__title">О товаре</h2>
                    <div class="prose">
                        {!! $this->product->translateAttribute('description') !!}
                    </div>
                </div>
            </div>
        </div>
        @livewire('components.review')
    </div>
</section>
<script>
    let priceText = document.querySelector('.product_data-price-perm2 span').textContent;
    let quantity = document.querySelector('#quantity');
    quantity.style.display = 'none'
    // Оставить только число (заменяем запятую на точку, убираем всё кроме цифр и точки)
    let floatValue = parseFloat(priceText.replace(',', '.').replace(/[^\d.]/g, ''));
    // Настройки
    const productData = {
        pricePerM2: floatValue,           // цена за м2 (замени на свою!)
        sumLabel: 'UZS',
        minM2: 1.76,                // минимальное количество (размер упаковки)
        stepM2: 1.76,               // шаг (размер упаковки)
        maxM2: 50 * 1.76,           // максимум (по желанию)
        startM2: 1.76,              // начальное значение
    };

    let currentM2 = productData.startM2;

    // DOM-элементы
    const qtyValueEl = document.getElementById('qty-value');
    const totalPriceEl = document.getElementById('total-price');

    // Кнопки
    const plusBtn = document.getElementById('plus-btn');
    const minusBtn = document.getElementById('minus-btn');

    // Обновление отображения
    function updateProductDisplay() {
        // Отображаем количество
        qtyValueEl.innerHTML = `${currentM2.toFixed(2)} м<sup>2</sup>`;
        // Цена округляется до целого
        const total = productData.pricePerM2 * currentM2 / 1.76;
        totalPriceEl.textContent = `${total.toLocaleString()} ${productData.sumLabel}`;
    }

    // Обработчики событий
    plusBtn.addEventListener('click', function () {
        if (currentM2 + productData.stepM2 <= productData.maxM2) {
            quantity.value = parseInt(quantity.value) + 1;
            currentM2 += productData.stepM2;
            updateProductDisplay();
        }
    });

    minusBtn.addEventListener('click', function () {
        if (currentM2 - productData.stepM2 >= productData.minM2) {
            quantity.value = parseInt(quantity.value) - 1;
            currentM2 -= productData.stepM2;
            updateProductDisplay();
        }
    });

    // Первый запуск
    updateProductDisplay();

</script>
