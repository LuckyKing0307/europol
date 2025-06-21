<div x-data="{ open: false }" class="fixed bottom-4 right-4 z-50 open_chat_btn">
    {{-- Кнопка --}}
    <div
        x-show="open"
        x-cloak
        x-transition
        @click.away="open = false"
        class="absolute chat_messanger bottom-16 right-0 w-80 h-[calc(100vh-6rem)] bg-white shadow-xl rounded-tl-lg rounded-tr-lg flex flex-col overflow-hidden"
    >
        {{-- Заголовок --}}
        <div class="px-4 py-2 bg-gray-100 font-medium border-b">
            Чат поддержки
        </div>
        <div class="contacts p-4">
            <div class="social">
                <a href="" class="social_class"><img width="32" height="32" src="{{asset('img/telegramm.svg')}}" alt=""> Telegramm</a>
            </div>
            <div class="social">
                <a href="" class="social_class"><img width="32" height="32" src="{{asset('img/whatsapp.svg')}} " alt=""> Whatsapp</a>
            </div>
        </div>
        {{-- Сообщения --}}
        <div class="px-4 overflow-y-auto space-y-2">
            @foreach($messages as $msg)
                <div class="flex {{ $msg['fromVisitor'] ? 'justify-end' : 'justify-start' }}">
                    <div
                        @class([
                          'px-3 py-2 rounded-lg max-w-[75%]',
                          'bg-blue-100 text-blue-800'  => $msg['fromVisitor'],
                          'bg-gray-200 text-gray-800'  => ! $msg['fromVisitor'],
                        ])
                    >
                        {{ $msg['text'] }}
                        <div class="text-xs text-gray-500 mt-1 text-right">
                            {{ $msg['time'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Форма ввода --}}
        <form wire:submit.prevent="sendMessage" class="border-t px-2 py-2 flex messanger_inputs">
            <input
                wire:model.defer="newText"
                type="text"
                placeholder="Введите сообщение…"
                class="flex-1 border rounded-lg px-3 py-2 focus:outline-none"
            />
            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 main_color"
            >
                Отправить
            </button>
        </form>
    </div>
    <button
        @click="open = !open"
        class="bg-blue-600  text-white p-3 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none main_color"
    >
        <template x-if="!open">
            {{-- Иконка чата --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 2.21-1.79 4-4 4H7l-4
                         4V6c0-2.21 1.79-4 4-4h10c2.21 0 4 1.79 4 4z"/>
            </svg>
        </template>
        <template x-if="open">
            {{-- Иконка закрытия --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </template>
    </button>

    {{-- Окно чата (absolutely positioned над кнопкой) --}}

</div>
