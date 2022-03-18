@props(['value', 'link' => '#', 'outline' => false])
<a 
    {{ $attributes->merge(["class"=>"inline-flex items-center h-8 px-4 text-sm transition-colors duration-150 rounded-lg focus:shadow-outline
    @if ($outline)
        text-primary-700 border border-primary-500 hover:bg-primary-500 hover:text-primary-100
    @else
        text-primary-100 bg-primary-700 hover:bg-primary-800
    @endif
    "]); }}
    href="{{ $link }}">
        {{ __($value) }}
    </a>

