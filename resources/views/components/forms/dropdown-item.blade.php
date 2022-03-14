@props(['item', 'order'])
<a 
    href="{{ $item->url }}"
    class="block px-4 py-2 text-sm font-medium text-white"
    :class="{'bg-primary-300': activeIndex === {{ $order }} }"
    role="menuitem"
    tabindex="-1"
    id="menu-item-{{ $order }}"
    x-on:mouseenter="activeIndex = {{ $order }}"
    x-on:mouseleave="activeIndex = -1"
    x-on:click="open = false">
    {{ $item->name }}
</a>
