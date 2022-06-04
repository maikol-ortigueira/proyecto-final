<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ __('edit') . ' ' . __('tag') }}
    </h2>
  </x-slot>

  @error('*')
    <div class="container mx-auto mt-10 rounded border-2 border-red-400 bg-red-200 py-5 px-4">
      <ul>
        @foreach ($errors->all() as $error)
          <li class="text-red-600">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @enderror

  <div class="container m-auto py-6">
    {{-- Formulario --}}
    <form action="{{ route('admin.etiquetas.update', $etiqueta) }}" id="etiquetaForm" method="post"
      enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mt-6 grid grid-cols-12">
        {{-- columna izquierda --}}
        <div class="col-span-12 md:col-span-6">
          <div class="grid grid-cols-12 gap-4">
            {{-- Campo nombre --}}
            <div class="col-span-12 md:col-span-6">
              <div class="mb-4"><label for="nombre" class="w-full capitalize">{{ __('name') }}</label></div>
              <div><input type="text" name="nombre" id="nombre" class="w-full rounded border-gray-300"
                  value="{{ old('nombre', $etiqueta->nombre) }}"></div>
              <div> {{-- Captura el error si existe --}}
                @error('nombre')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo nombre --}}
          </div>
        </div>
        {{-- columna derecha --}}
        <div class="col-span-12 md:col-span-6"></div>
      </div>
      {{-- Botón submit --}}
      <div class="my-10 text-left">
        <a href="{{ route('admin.etiquetas.index') }}" class="rounded bg-red-500 py-1 px-2 capitalize text-red-100 hover:bg-red-800" >{{ __('close') }}</a>
        <button
          class="rounded bg-green-500 py-1 px-2 capitalize text-green-100 hover:bg-green-800">
          {{ __('update') }}
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
