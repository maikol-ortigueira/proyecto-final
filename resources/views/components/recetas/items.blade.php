@props(['recetas'])
<div class="recetas-items">
    <div class="grid grid-cols-2 gap-x-20">
        @foreach ($recetas as $item)
            <x-recetas.item :receta="$item" />
        @endforeach
    </div>
</div>
