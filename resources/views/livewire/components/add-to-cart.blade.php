<div class="add_to_cart cart_{{ $productId }}" @if(!$shouldIgnore)
    wire:ignore.self
    @endif>
    <div class="product_data-qty">
        <button class="product_data-btn product_data-btn--minus" wire:click="decrement">−</button>
        <div class="product_data-qty-value">
            {{ number_format($qty_float, 2, '.', ' ') }} м<sup>2</sup>
        </div>
        <button class="product_data-btn product_data-btn--plus" wire:click="increment" wire:ignore.self>+</button>
    </div>
    <div class="close_cart">
        <button id="close-filter" class="close-btn" onclick="closeFilter('cart_{{ $productId }}')">✕</button>
    </div>
    <div class="gap-4">
        <button type="submit"
                class="add_to_cart_btn w-full px-6 py-4 text-sm font-medium text-center text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 add_tocart"
                wire:click.prevent="addToCart">
            {{ __('cart.add') }}
        </button>
    </div>

    @if ($errors->has('quantity'))
        <div class="p-2 mt-4 text-xs font-medium text-center text-red-700 rounded bg-red-50" role="alert">
            @foreach ($errors->get('quantity') as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>
