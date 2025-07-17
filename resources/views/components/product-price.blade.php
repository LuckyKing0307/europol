<span {{ $attributes }}>
    {{ $price ? $product->variants->first()->price : '0,00 UZS' }}
</span>
