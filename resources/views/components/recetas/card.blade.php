@props(['receta'])
<div class="w-full overflow-hidden rounded-lg shadow-lg sm:flex">
  <div class="w-full sm:w-1/3">
    @if (isset($receta->fotos) && count($receta->fotos) > 0)
      <img class="h-80 w-full object-cover" src="{{ url($receta->fotos[0]->url) }}" alt="{{ $receta->nombre }}" />
    @else

    @endif
  </div>

  <div class="flex-1 px-6 py-4">
    <a href="{{ route('recetas.show', ['receta' => $receta]) }}">
      <h4 class="mb-3 text-xl font-semibold tracking-tight text-gray-800">{{ $receta->nombre }}</h4>
    </a>
    <p class="leading-normal text-gray-700">{!! $receta->descripcion !!}</p>
    <div class="mt-1 mb-4 text-xs">
      <div class="mb-1">
        {{ __('Created by ') }}
        <a href="{{ route('recetas.index', ['autor' => $receta->autor->id]) }}"
          class="text-secondary-700 hover:text-secondary-400">
          {{ $receta->autor->name }}
        </a>
      </div>
      <div class=""> {{ __('Category') }}: <a
          href="{{ route('recetas.index', ['categoria' => $receta->categoria]) }}"
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
    <div class="mt-4 text-right">
      <x-button.link value="View recipe" :link="route('recetas.show', ['receta' => $receta])" :outline="true" />
    </div>
  </div>
</div>
