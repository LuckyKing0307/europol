@if ($paginator->hasPages())
    @php
        $allPages = collect();
        foreach ($elements as $element) {
            if (is_array($element)) {
                $allPages = collect($element);
            }
        }

        $pageCount = $paginator->lastPage();
        $half = ceil($pageCount / 2);
        $current = $paginator->currentPage();
    @endphp

    <nav class="flex items-center justify-center space-x-2 pagination_list">

        {{-- Left part (first half) --}}
        @foreach ($allPages->slice(0, $half) as $page => $url)
            @if ($page == $current)
                <span class="rounded-full border p-2 font-bold text-blue-600" style="color: white;">{{ $page }}</span>
            @else
                <button wire:click="gotoPage({{ $page }})" class="p-2 hover:text-blue-500 texted_btn" style="color: white;">{{ $page }}</button>
            @endif
        @endforeach

        {{-- Arrows --}}
        @if ($paginator->onFirstPage())
            <span class="rounded-full border p-2 text-gray-400 cursor-not-allowed arrow_btn"><img src="{{asset('img/arrow.svg')}}" alt=""></span>
        @else
            <button wire:click="previousPage" class="rounded-full border p-2 hover:bg-gray-100 transition arrow_btn"><img src="{{asset('img/arrow.svg')}}" alt=""></button>
        @endif

        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" class="rounded-full border p-2 hover:bg-gray-100 transition arrow_btn arrow_right"><img src="{{asset('img/arrow.svg')}}" alt=""></button>
        @else
            <span class="rounded-full border p-2 text-gray-400 cursor-not-allowed arrow_btn arrow_right"><img src="{{asset('img/arrow.svg')}}" alt=""></span>
        @endif
ф
        {{-- Right part (second half) --}}
        @foreach ($allPages->slice($half) as $page => $url)
            @if ($page == $current)
                <span class="rounded-full border p-2 font-bold text-blue-600" style="color: white;">{{ $page }}</span>
            @else
                <button wire:click="gotoPage({{ $page }})" class="p-2 hover:text-blue-500 texted_btn" style="color: white;">{{ $page }}</button>
            @endif
        @endforeach

    </nav>
@endif
