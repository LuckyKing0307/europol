<li x-data="{ open: false }"
    @mouseenter="open = true"
    @mouseleave="open = false"
    class="flex items-center gap-2 menu_li_data"  {{-- relative: якорь для absolute меню --}}
    wire:key="node-{{ $node->id }}"
>
    {{-- Картинка + ссылка --}}
    <img src="{{ $node->getFirstMediaUrl('images') }}"
         alt="{{ $node->translateAttribute('name') }}"
         class="w-8 h-8 rounded object-cover" loading="lazy">

    <a href="{{ route('collection.view', $node->defaultUrl->slug) }}"
       class="text-sm font-medium">{{ $node->translateAttribute('name') }}</a>

    {{-- Подменю --}}
    @if ($node->children->isNotEmpty())
        <ul x-show="open"
            x-cloak
            x-transition
            class="absolute sub_menu_data top-0 space-y-4 bg-white border border-gray-100 shadow-xl p-6"
        >
            @foreach ($node->children as $child)
                <livewire:components.collection-node
                    :node="$child"
                    :level="$level + 1"
                    :key="'node-'.$child->id"
                />
            @endforeach
        </ul>
    @endif
</li>

