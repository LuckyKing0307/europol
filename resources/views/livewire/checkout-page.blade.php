<div style="margin-top: 50px;">
    <div class="max-w-screen-xl mx-auto">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-start">
            <div
                class="px-6 py-8 space-y-4 bg-white border border-gray-100 lg:sticky lg:top-8 rounded-xl lg:order-last">
                <h3 class="font-medium">
                    {{ __('order.summary') }}
                </h3>
                <div class="flow-root">
                    <div class="-my-4 divide-y divide-gray-100">
                        @foreach ($cart->lines as $line)
                            <div class="flex items-center py-4" wire:key="cart_line_{{ $line->id }}">
                                <img class="object-cover w-16 h-16 rounded"
                                     src="{{ $line->purchasable->getThumbnail()->getUrl() }}"/>

                                <div class="flex-1 ml-4">
                                    <p class="text-sm font-medium max-w-[35ch]" style="color: #0a0a0a !important;">
                                        {{ $line->purchasable->getDescription() }}
                                    </p>

                                    <div class="mt-1 text-xs text-gray-500">
                                        {{ $line->quantity }} × {{ $line->subTotal->formatted() }}
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="flex items-center mt-2 space-x-2 text-sm justify-between " style="width: 50%;">
                                            <button
                                                class="px-2 py-1  bg-gray-600 rounded hover:bg-gray-700 header_btn"
                                                style="color:#000; margin-left: 0;"
                                                wire:click="decreaseQuantity('{{ $line->id }}')"
                                                title="Уменьшить количество">–</button>
                                            <span>{{ $line->quantity }}</span>
                                            <button
                                                class="px-2 py-1  bg-gray-600 rounded hover:bg-gray-700 header_btn"
                                                style="color:#000; margin-left: 0;"
                                                wire:click="increaseQuantity('{{ $line->id }}')"
                                                title="Увеличить количество">+</button>
                                        </div>
                                        <button class="p-2 ml-auto text-gray-600 transition-colors rounded-lg hover:bg-gray-100 hover:text-gray-700" type="button" wire:click="removeLine('{{ $line->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flow-root">
                    <dl class="-my-4 text-sm divide-y divide-gray-100">
                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                {{ __('order.subtotal') }}
                            </dt>
                            <dd class="w-1/2 text-right">
                                {{ $cart->subTotal->formatted() }}
                            </dd>
                        </div>

                        @if ($this->shippingOption)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $this->shippingOption->getDescription() }}
                                </dt>
                                <dd class="w-1/2 text-right">
                                    {{ $this->shippingOption->getPrice()->formatted() }}
                                </dd>
                            </div>
                        @endif

                        @foreach ($cart->taxBreakdown->amounts as $tax)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $tax->description }}
                                </dt>
                                <dd class="w-1/2 text-right">
                                    {{ $tax->price->formatted() }}
                                </dd>
                            </div>
                        @endforeach

                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                {{ __('order.total') }}
                            </dt>
                            <dd class="w-1/2 text-right">
                                {{ $cart->total->formatted() }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-2">
                @include('partials.checkout.address', [
                    'type' => 'shipping',
                    'step' => $steps['shipping_address'],
                ])
            </div>
        </div>
    </div>
</div>
