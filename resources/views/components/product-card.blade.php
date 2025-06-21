@props(['product'])
@php
$info = [
            'klass-iznosostoikosti' => [
                'img' => 'img/shield.svg',
                'key' => 'Класс износостойкости:',
                'value' => $product->translateAttribute('klass-iznosostoikosti')!='' ? $product->translateAttribute('klass-iznosostoikosti') : 0
            ],
            'tolshhina-paneli' => [
                'img' => 'img/tolshina.svg',
                'key' => 'Толщина панели:',
                'value' => $product->translateAttribute('tolshhina-paneli') != '' ? $product->translateAttribute('tolshhina-paneli').' мм' : 0
            ],
            'faska-po-perimetru' => [
                'img' => 'img/faska.svg',
                'key' => 'Фаска по периметру:',
                'value' => $product->translateAttribute('faska-po-perimetru') != '' ? $product->translateAttribute('faska-po-perimetru') : 'Нету'
            ],
            'ploshhad' => [
                'img' => 'img/ploshhad.svg',
                'key' => 'Площадь в упаковке:',
                'value' => $product->translateAttribute('ploshhad') != '' ? $product->translateAttribute('ploshhad').' м²' : 0
            ],
        ]
@endphp
<div class="swiper-slide product p-4">
    <a class="rounded-lg text-center product_medium_img"
       href="{{ route('product.view', $product->defaultUrl->slug) }}"
       wire:navigate>
        @if ($product->thumbnail)
            <img class="object-cover transition-transform duration-300 group-hover:scale-105"
                 src="{{ $product->thumbnail->getUrl('medium') }}"
                 alt="{{ $product->translateAttribute('name') }}"/>
        @endif
    </a>
    <div class="product_details">
        <a class="price_product"
           href="{{ route('product.view', $product->defaultUrl->slug) }}"
           wire:navigate
        >
            <div class="text-red-600 font-bold text-lg">
                <span class="sale_price"><x-product-price :product="$product"/></span>
            </div>
            <div class="text-sm font-medium mb-2 product_title">
                {{$product->translateAttribute('name')}}
            </div>
        </a>

        <div class="product_info">
            @foreach($info  as $product_info)
                <p class="product_info_text"><img
                            src="{{asset($product_info['img'])}}"><span> {{$product_info['key']}} </span>{{$product_info['value']!='' ? $product_info['value']  : 'нет'}}
                </p>
            @endforeach
            <p class="product_info_text"><img src="{{asset('img/car.svg')}}">Бесплатная доставка по городу</p>
        </div>

        <div class="in_stock">В наличии</div>
        <div class="action">
            <div class="basket" onclick="openCart('cart_{{$product->variants->first()->id}}')">
                <img src="{{asset('img/card.svg')}}" alt="Корзина">В корзину
            </div>
            <div class="like">
                <img src="{{asset('img/like-icon.svg')}}" alt="Лайк">
            </div>
            <livewire:components.add-to-cart :purchasable="$product->variants->first()"
                                             :wire:key="$product->variants->first()->id">
        </div>
    </div>
</div>
<script defer>
    function openCart(e){
        document.querySelector('.'+e).style.display = 'flex';
    }
    function closeFilter(e){
        document.querySelector('.'+e).style.display = 'none';
    }
</script>
