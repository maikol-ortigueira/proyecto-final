@props(['receta'])
<div class="recetas-item grid grid-cols-8 gap-3 mb-6 pb-3 border-b-2">
    <div class="imagen col-span-2">
        <img src="{{ url($receta->fotos[0]->url) }}" class="object-cover h-24 mt-2" alt="" />
    </div>
    <div class="contenido col-span-6 flex flex-col gap-2">
        <h2 class="text-3xl text-primary-500">{{ $receta->nombre }}</h2>
        <div>
            {!! $receta->descripcion !!}
        </div>
        <div class="etiquetas flex flex-row gap-2">
            @foreach ($receta->etiquetas as $etiqueta)
                <x-recetas.etiqueta :etiqueta="$etiqueta" />
            @endforeach
        </div>
    </div>
</div>
