@props(['recetas'])
<div class="flex flex-col gap-8">
    @foreach ($recetas as $item)
        <x-recetas.card :receta="$item" />
    @endforeach
</div>