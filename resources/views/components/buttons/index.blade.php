@props(['position', 'href' => false, 'type' => 'submit'])
@php
$position = $position ?? false;
@endphp
@if ($position)
    @php
        $posClass = $position === 'first' ? 'rounded-l-md' : 'rounded-r-md';
    @endphp
@endif
@if (!$href)
<button type="{{ $type }}" @else <a href="{{ $href }}" @endif
        class="
    inline-flex
    items-center
    py-2
    px-4
    gap-2
    text-sm
    font-medium
    text-green-900
    bg-transparent
    {{ $posClass ?? '' }}
    border
    border-green-900
    hover:bg-green-900
    hover:text-white
    focus:z-10
    focus:ring-2
    focus:ring-green-500
    focus:bg-green-900
    focus:text-white
    dark:border-white
    dark:text-white
    dark:hover:text-white
    dark:hover:bg-green-700
    dark:focus:bg-green-700"
        >
        {{ $slot }}
        @if (!$href)
    </button>
@else
    </a>
@endif

