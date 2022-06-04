<x-guest-layout>
  <div class="container mx-auto mt-10 px-4 sm:px-0">
    {{-- nombre de la receta --}}
    <div class="border-secondary-400 mb-2 border-b">
      <h1 class="text-3xl font-bold">{{ $receta->nombre }}</h1>
    </div>

    <div class="mb-4 grid sm:grid-cols-2 gap-3">
      <div class="inline-flex gap-2">
        {{-- raciones --}}
        <div class="inline-block rounded-2xl bg-gray-100 py-1 px-4 text-sm">
          <span>{{ $receta->raciones }}</span>
          <span class="text-secondary-500">{{ __('pers.') }}</span>
        </div>
        {{-- categoria --}}
        <div class="inline-block rounded-2xl bg-gray-100 py-1 px-4 text-sm">
          <span>{{ __('categ.') }}</span>
          <span class="text-secondary-500">{{ $receta->categoria->nombre }}</span>
        </div>
      </div>
      <div class="sm:text-right">
        {{-- autor --}}
        <div class="text-sm">
          <span class="text-secondary-500">{{ __('by') }}</span>
          <span>{{ $receta->autor->name }}</span>
        </div>
      </div>
    </div>
    {{-- fotos de la receta --}}
    @if (isset($receta->fotos) && count($receta->fotos) > 0)
      <div class="mb-6 gap-8 flex flex-col md:flex-row">
        @foreach ($receta->fotos as $foto)
          <div class="max-h-72">
            <img src="{{ asset('/storage/' . $foto->url) }}" alt="Foto receta {{ $receta->nombre }}"
              class="w-auto sm:h-full m-auto max-h-72">
          </div>
        @endforeach
      </div>
    @endif
    {{-- ingredientes --}}
    @if (isset($receta->ingredientes) && count($receta->ingredientes) > 0)
      <div class="grid grid-cols-6">
        <div class="col-span-6 rounded bg-gray-100 py-4 px-6 md:col-span-4">
          <h2 class="mb-4 text-2xl font-bold capitalize underline">{{ __('ingredients') }}</h2>
          <ul>
            @foreach ($receta->ingredientes as $ingrediente)
              <li>
                {{-- ingrediente --}}
                {{ $ingrediente->nombre }}
                {{-- cantidad --}}
                {{ $ingrediente->pivot->cantidad }}
                {{-- unidad --}}
                <span>{{ App\Models\Unidad::find($ingrediente->unidad_id)->nombre }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    {{-- descripción --}}
    <div class="my-16">
      {!! $receta->descripcion !!}
    </div>
    {{-- pasos --}}
    @if (isset($receta->pasos) && count($receta->pasos) > 0)
      <div class="my-8">
        <h2 class="mb-6 text-3xl font-bold capitalize underline">{{ __('preparation') }}</h2>
        @foreach ($receta->pasos as $paso)
          <div class="my-8 border-b pb-10">
            {{-- Nombre del paso --}}
            <div>
              <h3 class="my-4 text-xl font-semibold capitalize underline">{{ $paso->nombre }}</h3>
            </div>
            {{-- Descripción --}}
            <div class="my-4">{{ $paso->descripcion }}</div>
            {{-- Fotos --}}
            @if (isset($paso->fotos) && count($paso->fotos) > 0)
              <div class="mb-6 gap-8 flex flex-col md:flex-row">
                @foreach ($paso->fotos as $foto)
                  <div class="max-h-64">
                    <img src="{{ asset('/storage/' . $foto->url) }}"
                      alt="Foto paso {{ $paso->nombre }} de la receta" class="h-full m-auto max-h-64">
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        @endforeach
      </div>
    @endif
  </div>
</x-guest-layout>
