<li x-data="{ open: false }"
    @mouseenter="open = true"
    @mouseleave="open = false"
    class="flex items-center gap-2 menu_li_data"  {{-- relative: якорь для absolute меню --}}
    wire:key="node-{{ $node['brand'] ? $node['brand']->id : $node->id}}"
>
    <img src="{{ $node['brand'] ? $node['brand']->getFirstMediaUrl('images') : $node->getFirstMediaUrl('images') }}"
         alt="{{ $node['brand'] ? $node['brand']->name : $node->translateAttribute('name') }}"
         class="w-8 h-8 rounded object-cover" loading="lazy">

    <a href="{{ route('collection.view', $node['brand'] ? $node['brand']->defaultUrl?->slug : $node->defaultUrl?->slug ) }}"
       class="text-sm font-medium">{{ $node['brand'] ? $node['brand']->name : $node->translateAttribute('name')}}</a>
    @if (isset($node->brands))
        <ul x-show="open"
            x-cloak
            x-transition
            class="absolute sub_menu_data top-0 space-y-4 bg-white border border-gray-100 shadow-xl p-6"
        >
            @foreach ($node->brands as $child)
                <livewire:components.collection-node
                    :node="$child"
                    :level="$level + 1"
                    :key="'node-'.$child['brand']->id"
                />
            @endforeach
        </ul>
    @endif
    @if (isset($node['collections']))
        <ul x-show="open"
            x-cloak
            x-transition
            class="absolute sub_menu_data top-0 space-y-4 bg-white border border-gray-100 shadow-xl p-6"
        >
            @foreach ($node['collections'] as $child)
                <livewire:components.collection-node
                    :node="$child"
                    :level="$level + 1"
                    :key="'node-'.$child->id"
                />
            @endforeach
        </ul>
    @endif
</li>

