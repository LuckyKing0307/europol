<button wire:click="toggleLike" class="{{ $liked ? 'text-red-600' : 'text-gray-400' }}">
    <div class="like">
        @if ($liked)
            <img src="{{asset('img/liked.svg')}}" alt="Удалить Лайк">
        @else
            <img src="{{asset('img/like-icon.svg')}}" alt="Лайк">
        @endif
    </div>
</button>
