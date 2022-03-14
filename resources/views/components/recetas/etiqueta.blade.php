@props(['etiqueta'])
{{-- <a href="?tag={{ $etiqueta->id }}&{{ http_build_query(request()->except('tag','page')) }}" class="border rounded border-primary-500 py-1 px-3 text-xs hover:bg-primary-500 hover:text-white">
    {{ $etiqueta->nombre }}
</a> --}}
<span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-primary-100 bg-primary-600 rounded-full">{{ $etiqueta->nombre }}</span>
