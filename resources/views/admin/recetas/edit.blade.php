<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
      {{ __('edit recipe') }}
    </h2>
  </x-slot>

  <div class="container m-auto py-6">
    <form action="{{ route('admin.recetas.update', $receta) }}" id="recetaForm" method="post"
      enctype="multipart/form-data" x-data="formulario()">
      @csrf
      @method('PATCH')

      {{-- Pestañas --}}
      <div class="border-b border-gray-200 dark:border-gray-700 mb-8">
        <ul class="-mb-px flex flex-wrap">
          {{-- Receta --}}
          <li class="mr-2" x-on:click="tab='receta'">
            <p
            :class="[tab === 'receta' 
              ? 'active inline-block rounded-t-lg border-b-2 border-blue-600 py-4 px-4 text-center text-sm font-medium text-blue-600 dark:border-blue-500 dark:text-blue-500' 
              : 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300' 
              ]">
              {{__('Recipe')}}</p>
          </li>
          {{-- Ingredientes --}}
          <li class="mr-2" x-on:click="tab='ingredientes'">
            <p
            :class="[tab === 'ingredientes' 
              ? 'active inline-block rounded-t-lg border-b-2 border-blue-600 py-4 px-4 text-center text-sm font-medium text-blue-600 dark:border-blue-500 dark:text-blue-500' 
              : 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300' 
              ]">
              {{__('Ingredientes')}}
            </p>
          </li>
          {{-- Pasos --}}
          <li class="mr-2" x-on:click="tab='pasos'">
            <p
            :class="[tab === 'pasos' 
              ? 'active inline-block rounded-t-lg border-b-2 border-blue-600 py-4 px-4 text-center text-sm font-medium text-blue-600 dark:border-blue-500 dark:text-blue-500' 
              : 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300' 
              ]">
              {{__('Steps')}}
            </p>
          </li>
        </ul>
      </div>

      {{-- Seccion de recetas --}}
      <div x-show="tab === 'receta'">
        {{-- Receta --}}
        <div class="grid grid-cols-6">
          {{-- Campo nombre --}}
          <div class="col-span-3 flex flex-col">
            <label for="nombre" class="capitalize">{{ __('name') }}<span
                class="ml-1">(*)</span></label>
            <input type="text"
              class="@error('nombre') border-red-300 @else border-gray-300 @enderror mt-2 rounded-md border py-2 px-4"
              name="nombre" id="nombre" value="{{ old('nombre', $receta->nombre) }}">
            {{-- Captura el error si existe --}}
            @error('raciones')
              <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="mt-4 grid grid-cols-10 gap-6">
          {{-- Campo porciones --}}
          <div class="col-span-1 flex flex-col">
            <label for="raciones" class="capitalize">{{ __('portions') }}<span
                class="ml-1">(*)</span></label>
            <input type="text"
              class="@error('raciones') border-red-300 bg-red-100 @else border-gray-300 @enderror mt-2 rounded-md border py-2 px-4"
              name="raciones" id="raciones" value="{{ old('raciones', $receta->raciones) }}">
            {{-- Captura error --}}
            @error('raciones')
              <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
          </div>
          {{-- Campo categoría --}}
          <div class="col-span-2 flex flex-col">
            <label for="categoria" class="capitalize">{{ __('category') }}<span
                class="ml-1">(*)</span></label>
            <select name="categoria" id="categoria" required
              class="@error('raciones') border-red-300 bg-red-100 @else border-gray-300 @enderror mt-2 rounded-md border bg-white py-2 px-4">
              {{-- Opción vacía --}}
              <option value="">- {{ __('Select category') }} -</option>
              {{-- Cargar opciones --}}
              @foreach ($categoriasReceta as $opcion)
                <option value="{{ $opcion->id }}" @if ($opcion->id === $receta->categoria->id) selected @endif>
                  {{ $opcion->nombre }}</option>
              @endforeach
            </select>
            {{-- Captura error --}}
            @error('categoria')
              <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div>
          {{-- Etiquetas --}}
          <x-forms.tags :etiquetas="$receta->etiquetas" />
        </div>
        {{-- Editor de texto --}}
        <div class="mt-10">
          <div id="editor" class="h-48 min-h-0 bg-white">{!! old('descripcion', $receta->descripcion) !!}</div>
        </div>
        {{-- imagenes --}}
        <div class="my-10 grid grid-cols-4">
          @foreach ($receta->fotos as $foto)
            <div id="contenedor-imagen-{{ $foto->id }}">
              <div class="relative mx-auto h-64 w-64">
                <img src="{{ $foto->url }}" class="h-64 w-full">
                <x-svgs.close-simbol class="absolute top-1 right-1 h-10 w-10 cursor-pointer rounded-3xl bg-white p-2"
                  x-on:click="borraImagen({{ $foto->id }})" />
              </div>
            </div>
          @endforeach
        </div>
        {{-- subida de nuevas imágenes --}}
        <x-forms.label name="fotos" label="add photos" field="fotos" />
        <x-forms.drag-and-drop-file name="fotos" />
      </div>
      <div x-show="tab === 'ingredientes' ">
        <h2 class="text-3xl mb-6">Ingredientes</h1>

      </div>
      {{-- Pasos --}}
      <div x-show="tab === 'pasos'">
        @php
            $orden = 0;
        @endphp
        @foreach ($receta->pasos as $paso)
          <x-recetas.paso  :paso="$paso" orden="{{ $orden }}" />
          @php
              $orden++;
          @endphp 
        @endforeach
      </div>
      {{-- Botón --}}
      <div class="my-10 text-right">
        <button x-on:click="guardaFormulario()"
          class="rounded bg-green-500 py-1 px-2 capitalize text-green-100 hover:bg-green-800">
          {{ __('update') }}
        </button>
      </div>
    </form>
  </div>
  <!-- Include the Quill library -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <!-- Initialize Quill editor -->
  <script>
    var quill = new Quill('#editor', {
      theme: 'snow'
    });

    function formulario() {
      return {
        tab: 'receta',
        active: 'active inline-block rounded-t-lg border-b-2 border-blue-600 py-4 px-4 text-center text-sm font-medium text-blue-600 dark:border-blue-500 dark:text-blue-500',
        not_active: 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300',

        borraImagen: (imagen) => {
          document.getElementById('contenedor-imagen-' + imagen).remove();
          let input = document.createElement('input');
          input.setAttribute('name', 'borrar_fotos[]');
          input.setAttribute('value', imagen);
          input.setAttribute('type', 'hidden');
          document.getElementById('recetaForm').appendChild(input);
        },
        guardaFormulario: () => {
          formulario = document.getElementById('recetaForm');
          let input = document.createElement('input');
          input.setAttribute('name', 'descripcion');
          input.setAttribute('value', quill.root.innerHTML);
          input.setAttribute('type', 'hidden')
          formulario.appendChild(input);

          formulario.submit();
        }
      }
    }
  </script>
</x-app-layout>
