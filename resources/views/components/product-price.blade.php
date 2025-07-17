<span {{ $attributes }}>
    @if($price && $price->price)
        {{ number_format($price->price->value * $rate / 100, 0, ',', ' ') }} UZS
    @else
        0,00 UZS
    @endif
</span>
