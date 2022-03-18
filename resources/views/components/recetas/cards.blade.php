@props(['recetas'])
<div class="flex flex-col gap-8">
    @if (isset($recetas))
        @foreach ($recetas as $item)
            <x-recetas.card :receta="$item" />
        @endforeach
    @else
        <h2 class="text-3xl">No tenemos de momento ninguna receta para mostrar</h2>        
    @endif
</div>