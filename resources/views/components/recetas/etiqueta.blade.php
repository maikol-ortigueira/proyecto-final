@props(['etiqueta'])
<a href="{{ route('recetas.index', ['etiqueta' => $etiqueta]) }}" class="border rounded border-primary-500 py-1 px-3 text-xs hover:bg-primary-500 hover:text-white">
    {{ $etiqueta->nombre }}
</a>
