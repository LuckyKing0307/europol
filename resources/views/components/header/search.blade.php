    <form
      action="{{ route('search.view') }}" class="w-full relative">
    <input name="term"
           type="search"
           placeholder="Что бы вы хотели найти?"
           class="w-full pl-10 text-sm border-2 border-gray-100 search_input"
           value="{{ $this->term }}" />

    <button class="absolute p-2 text-gray-600 transition -translate-y-1/2 top-1/2 hover:bg-gray-50 search_btn">
        <span class="sr-only">{{__('search.title')}}</span>

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="#FFFFFF">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        Найти
    </button>
</form>
