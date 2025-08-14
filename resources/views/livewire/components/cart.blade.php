<div class="sm:relative"
     x-data="{ linesVisible: @entangle('linesVisible').live }">
    <div class="bg_black"
         x-show="linesVisible"
         x-transition:enter="transition-opacity duration-500"
         x-transition:leave="transition-opacity duration-500">
    </div>

    <div class="flex justify-between">
        <button class="header_btn" x-on:click="linesVisible = !linesVisible">
            <span class="sr-only">Cart</span>
            <span class="place-self-center">
                <img src="{{ asset('img/card.svg') }}" alt="Корзина">
            </span>
        </button>

        <a class="header_btn" href="{{ route('favorites.view') }}">
            <span class="sr-only">Favorites</span>
            <span class="place-self-center">
                <img src="{{ asset('img/like.svg') }}" alt="Понравившиеся товары">
            </span>
        </a>
    </div>

    <div class="absolute inset-x-0 top-auto z-50 w-screen max-w-sm px-6 py-8 mx-auto mt-4 bg-white border border-gray-100 shadow-xl sm:left-auto rounded-xl basket_data"
         x-show="linesVisible"
         x-on:click.away="linesVisible = false"
         x-transition
         x-cloak>

        <button class="absolute text-gray-500 transition-transform top-3 right-3 hover:scale-110"
                type="button"
                aria-label="Close"
                x-on:click="linesVisible = false">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div>
            @if ($this->cart && $lines)
                <div class="flow-root">
                    <ul class="-my-4 overflow-y-auto divide-y divide-gray-100 max-h-96">
                        @foreach ($lines as $index => $line)
                            <li wire:key="line_{{ $line['id'] }}">
                                <div class="flex py-4">
                                    @if ($line['thumbnail'])
                                        <img class="object-cover w-16 h-16 rounded"
                                             src="{{ $line['thumbnail'] }}">
                                    @endif

                                    <div class="flex-1 ml-4">
                                        <p class="max-w-[20ch] text-sm font-medium" style="color: black !important;">
                                            {{ $line['description'] }}
                                        </p>
                                        <span class="block mt-1 text-xs text-gray-500">
                                            {{ $line['identifier'] }} / {{ $line['options'] }}
                                        </span>

                                        <div class="flex items-center mt-2">
                                            <input class="w-16 p-2 text-xs transition-colors border border-gray-100 rounded-lg hover:border-gray-200"
                                                   type="number"
                                                   wire:model.live="lines.{{ $index }}.quantity"
                                                   wire:change="updateLines" />

                                            <p class="ml-2 text-xs">
                                                @ {{ $line['unit_price'] }}
                                            </p>

                                            <button class="p-2 ml-auto text-gray-600 transition-colors rounded-lg hover:bg-gray-100 hover:text-gray-700"
                                                    type="button"
                                                    wire:click="removeLine('{{ $line['id'] }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-4 h-4"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->get('lines.' . $index . '.quantity'))
                                    <div class="p-2 mb-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
                                         role="alert">
                                        @foreach ($errors->get('lines.' . $index . '.quantity') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                <dl class="flex flex-wrap pt-4 mt-6 text-sm border-t border-gray-100">
                    <dt class="w-1/2 font-medium">{{ __('cart.total') }}</dt>
                    <dd class="w-1/2 text-right">{{ $this->cart->subTotal->formatted() }}</dd>
                </dl>

                <div class="mt-4 space-y-4 text-center">
                    <a class="checkout_btn block w-full p-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                       href="{{ route('checkout.view') }}"
                       wire:navigate>
                        {{ __('cart.checkout') }}
                    </a>

                    <a class="inline-block text-sm font-medium text-gray-600 underline hover:text-gray-500"
                       href="{{ url('/') }}" style="color: black !important;">
                        {{ __('cart.continue') }}
                    </a>
                </div>
            @else
                <p class="py-4 text-lg font-medium text-center text-gray-500 basket_empty">
                    {{ __('cart.empty_title') }} <br>
                    <span class="py-4 text-lg font-medium text-center text-gray-500"  style="color: black !important;">
                        {{ __('cart.empty_subtitle') }}
                    </span>
                </p>

                <div class="mt-4 space-y-4 text-center"  style="color: black !important;">
                    <a class="inline-block text-sm font-medium text-gray-600 underline hover:text-gray-500"
                       href="{{ url('/') }}">
                        {{ __('cart.continue') }}

                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
