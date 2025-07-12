<span {{ $attributes }}>
    {{ $price ? $price->price->formatted() : '0' }}
</span>
