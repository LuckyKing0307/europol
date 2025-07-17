@props(['product','rate'])
<div class="swiper-slide product p-4">
    <a class="rounded-lg text-center product_medium_img"
       href="{{ route('product.view', $product->defaultUrl->slug) }}">
        @if ($product->thumbnail)
            <img class="object-cover transition-transform duration-300 group-hover:scale-105"
                 src="{{ $product->thumbnail->getUrl('medium')}}"
                 alt="{{ $product->translateAttribute('name') }}"/>
        @else
            <img class="object-cover transition-transform duration-300 group-hover:scale-105"
                 src="{{asset('img/empty.png') }}"
                 alt="empty"/>
        @endif
    </a>
    <div class="product_details">
        <a class="price_product"
           href="{{ route('product.view', $product->defaultUrl->slug) }}">
            <span class="sku">SKU : {{$product->external_id}}</span>
            <div class="text-red-600 font-bold text-lg">
                @if($rate!='')
                    <span class="sale_price"><x-product-price :product="$product" :variant="null" :rate="$rate"/></span>
                @else
                    <span class="sale_price"><x-product-price :product="$product"/></span>
                @endif
            </div>
            <div class="text-sm font-medium mb-2 product_title">
                {{$product->translateAttribute('name')}}
            </div>
        </a>

        <a class="rounded-lg text-center product_medium_img"
           href="{{ route('product.view', $product->defaultUrl->slug) }}">
        <div class="product_info">
            @foreach($product->characteristics()->limit(4)->get()  as $product_info)
                <p class="product_info_text"><img
                            src=""><span> {{$product_info['key']}} </span>{{$product_info['value']!='' ? $product_info['value']  : 'нет'}}
                </p>
            @endforeach
            <p class="product_info_text"><img src="{{asset('img/car.svg')}}">Бесплатная доставка по городу</p>
        </div>
        </a>

        <div class="in_stock">В наличии</div>
        <div class="action">
            <div class="basket" onclick="openCart('cart_{{$product->variants->first()->id}}')">
                <img src="{{asset('img/card.svg')}}" alt="Корзина">В корзину
            </div>
            <livewire:components.add-to-cart :purchasable="$product->variants->first()"
                                             :productId="$product->id"
                                             :wire:key="$product->variants->first()->id">
            <livewire:components.like-button :productId="$product->id">
        </div>
    </div>
</div>
