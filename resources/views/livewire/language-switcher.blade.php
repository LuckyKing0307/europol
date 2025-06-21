<div class="relative inline-block text-left">
    <button wire:click="toggleDropdown" class="flex items-center gap-2 px-4 py-2 rounded language_option">
        <img src="{{ asset('flags/' . $currentFlag . '.svg') }}" alt="{{ $currentLanguage }}" class="w-6 h-6 rounded-full">
        <span class="text-lg">{{ strtoupper($currentLanguage) }}</span>
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    @if($open)
        <div class="absolute mt-2 w-32 bg-white shadow-lg rounded z-10">
            @foreach($languages as $lang => $label)
                <button wire:click="switchLanguage('{{ $lang }}')" class="flex items-center gap-2 w-full px-3 py-2 hover:bg-gray-100 language_option">
                    <img src="{{ asset('flags/' . $lang . '.svg') }}" alt="{{ $label }}" class="w-5 h-5 rounded-full">
                    <span>{{ strtoupper($lang) }}</span>
                </button>
            @endforeach
        </div>
    @endif
</div>
