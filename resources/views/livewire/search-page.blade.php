<section>
    @foreach ($this->results as $result)
        <x-product-card :product="$result" />
    @endforeach
</section>
