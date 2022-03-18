<x-guest-layout>
  <div>
      {{-- nombre de la receta --}}
    <h1>{{ $receta->nombre }}</h1>
    {{-- descripción --}}
    <div>
      {!! $receta->descripcion !!}
    </div>
    {{-- raciones --}}
    <div>
      <span>{{ __('portions') }}</span>
      <span>{{ $receta->porciones }}</span>
    </div>
    {{-- ingredientes --}}
    @if (isset($receta->ingredientes) && count($receta->ingredientes) > 0)
        <ul>
            @foreach ($receta->ingredientes as $ingrediente)
            <li>
                {{-- ingrediente --}}
                {{-- <span>{{ App\Models\Ingrediente::where($ingrediente-> }}</span> --}}
                {{-- cantidad --}}
                {{-- unidad --}}
            </li>
            @endforeach
        </ul>
    @endif
    <div></div>
    {{-- categoria --}}
    <div>
      <span>{{ __('category') }}</span>
      <span>{{ App\Models\Categoria::where($receta->categoria)->nombre }}</span>
    </div>
    {{-- autor --}}
    <div>
      <span>{{ __('autor') }}</span>
      <span>{{ $receta->autor->nombre }}</span>
    </div>
    {{-- fotos de la receta --}}
    @if (isset($receta->fotos) && count($receta->fotos) > 0)
      <div>
        @foreach ($receta->fotos as $foto)
          <div>
            <img src="{{ asset('/storage/recetas/' . url($foto->url)) }}" alt="Foto receta {{ $receta->nombre }}">
          </div>
        @endforeach
      </div>
    @endif
    {{-- pasos --}}
  </div>
</x-guest-layout>
