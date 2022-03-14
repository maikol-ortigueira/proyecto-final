@props(['receta'])
<div class="recetas-item mb-6 grid grid-cols-8 gap-3 border-b-2 pb-3">
  <div class="imagen col-span-2">
    <img src="{{ url($receta->fotos[0]->url) }}" class="mt-2 h-24 object-cover" alt="" />
  </div>
  <div class="contenido col-span-6 flex flex-col gap-2">
      <a href="{{ route('recetas.show', ['receta' => $receta]) }}">
        <h2 class="font-semibold text-primary-500 text-3xl hover:text-primary-800">{{ $receta->nombre }}</h2>
      </a>
    <div>
      {!! $receta->descripcion !!}
    </div>
    <div class="text-xs mt-1 mb-4">
      <div class="mb-1">
        {{ __('Created by ') }}
        <a href="{{ route('recetas.index', ['autor' => $receta->autor->id]) }}"
          class="text-secondary-700 hover:text-secondary-400">
          {{ $receta->autor->name }}
        </a>
      </div>
      <div class="">
        {{ __('Category') }}:
        <a href="{{ route('recetas.index', ['categoria' => $receta->categoria]) }}"
          class="text-secondary-700 hover:text-secondary-400">
           {{ $receta->categoria->nombre }}
        </a>
      </div>
    </div>
    <div class="etiquetas flex flex-row gap-2">
      @foreach ($receta->etiquetas as $etiqueta)
        <x-recetas.etiqueta :etiqueta="$etiqueta" />
      @endforeach
    </div>
  </div>
</div>
