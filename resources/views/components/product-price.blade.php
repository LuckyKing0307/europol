<span {{ $attributes }}>
    {{ $price ? ($price->price->value*$rate).',00 UZS' : '0,00 UZS' }}
</span>
