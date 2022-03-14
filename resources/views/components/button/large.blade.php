@props(['value', 'outline' => false])
<button 
    {{ $attributes->merge([]) }}
    class="h-12 px-6 m-2 text-lg transition-colors duration-150 rounded-lg focus:shadow-outline
        @if ($outline)
        text-primary-700 border border-primary-500 hover:bg-primary-500 hover:text-primary-100
        @else
        text-primary-100 bg-primary-700 hover:bg-primary-800
        @endif
        "
        >
    {{ __($value) }}
</button>