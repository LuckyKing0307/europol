<div class="mx-auto max-w-screen-2xl content_block">
    <div class="block_title">{{__('recommendatio.title')}}</div>
    <div class="block_content flex justify-between block_recomen">
            @foreach($recommendations as $recommendation)
            <div class="block_element relative">
                <img src="{{ $recommendation->getFirstMediaUrl('image') }}" alt="{{ $recommendation->title }}" class="w-full h-64 object-cover">
                <h3 class="recommendation_title">{{ $recommendation->title }}</h3>
                <p class="recommendation_text">{{ $recommendation->text }}</p>
            </div>
            <div class="block_element relative">
                <img src="{{ $recommendation->getFirstMediaUrl('image') }}" alt="{{ $recommendation->title }}" class="w-full h-64 object-cover">
                <h3 class="recommendation_title">{{ $recommendation->title }}</h3>
                <p class="recommendation_text">{{ $recommendation->text }}</p>
            </div>
            <div class="block_element relative">
                <img src="{{ $recommendation->getFirstMediaUrl('image') }}" alt="{{ $recommendation->title }}" class="w-full h-64 object-cover">
                <h3 class="recommendation_title">{{ $recommendation->title }}</h3>
                <p class="recommendation_text">{{ $recommendation->text }}</p>
            </div>
            <div class="block_element relative">
                <img src="{{ $recommendation->getFirstMediaUrl('image') }}" alt="{{ $recommendation->title }}" class="w-full h-64 object-cover">
                <h3 class="recommendation_title">{{ $recommendation->title }}</h3>
                <p class="recommendation_text">{{ $recommendation->text }}</p>
            </div>
            @endforeach
    </div>
</div>

