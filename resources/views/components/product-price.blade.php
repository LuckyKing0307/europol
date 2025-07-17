<span {{ $attributes }}>
    {{ $price ? $price->variants->first()->price : '0,00 UZS' }}
</span>

