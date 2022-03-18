<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
      {{ __('edit') . ' ' . __('recipe') }}
    </h2>
  </x-slot>

  @error('*')
    <div class="container mx-auto rounded border-2 border-red-400 bg-red-200 py-5 px-4 mt-10">
      <ul>
        @foreach ($errors->all() as $error)
          <li class="text-red-100">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @enderror

  <div class="container m-auto py-6">
    {{-- Formulario --}}
    <form action="{{ route('admin.recetas.update', $receta) }}" id="recetaForm" method="post"
      enctype="multipart/form-data" x-data="formulario()" x-init="init()">
      @csrf
      @method('PATCH')

      {{-- Pestañas --}}
      <div class="mb-8 border-b border-gray-200 dark:border-gray-700">
        <ul class="-mb-px flex flex-wrap">
          {{-- Receta --}}
          <li class="mr-2" x-on:click="tab='receta'">
            <p
              :class="[tab ==='receta' 
              ? 'active inline-block rounded-t-lg border-b-2 border-secondary-600 py-4 px-4 text-center text-sm font-medium text-secondary-600 dark:border-secondary-500 dark:text-secondary-500' 
              : 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 cursor-poniter' 
              ]">
              {{ __('Recipe') }}</p>
          </li>
          {{-- Ingredientes --}}
          <li class="mr-2" x-on:click="tab='ingredientes'">
            <p
              :class="[tab ==='ingredientes' 
              ? 'active inline-block rounded-t-lg border-b-2 border-secondary-600 py-4 px-4 text-center text-sm font-medium text-secondary-600 dark:border-secondary-500 dark:text-secondary-500' 
              : 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 cursor-poniter' 
              ]">
              {{ __('Ingredientes') }}
            </p>
          </li>
          {{-- Pasos --}}
          <li class="mr-2" x-on:click="tab='pasos'">
            <p
              :class="[tab ==='pasos' 
              ? 'active inline-block rounded-t-lg border-b-2 border-secondary-600 py-4 px-4 text-center text-sm font-medium text-secondary-600 dark:border-secondary-500 dark:text-secondary-500' 
              : 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 cursor-poniter' 
              ]">
              {{ __('Steps') }}
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
            @error('nombre')
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
              class="@error('categoria') border-red-300 bg-red-100 @else border-gray-300 @enderror mt-2 rounded-md border bg-white py-2 px-4">
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
        <x-forms.editor editor="descripcion" :content="old('descripcion', $receta->descripcion)"
          formname="recetaForm" />
        {{-- imagenes --}}
        <div class="my-10 grid grid-cols-4">
          @foreach ($receta->fotos as $foto)
            <div id="contenedor-imagen-{{ $foto->id }}">
              <div class="relative mx-auto h-64 w-64">
                {{-- <img src="{{ asset('storage/recetas/' . $foto->url) }}" class="h-64 w-full"> --}}
                <img src="{{ asset( '/storage/recetas/' . $foto->url) }}" class="h-64 w-full">
                <x-svgs.close-simbol class="absolute top-1 right-1 h-10 w-10 cursor-pointer rounded-3xl bg-white p-2"
                  x-on:click="borraImagen({{ $foto->id }})" />
              </div>
            </div>
          @endforeach
        </div>
        {{-- subida de nuevas imágenes --}}
        <x-forms.label name="fotos" label="{{__('add photos')}}" field="fotos" />
        <x-forms.drag-and-drop-file name="fotos" id="receta" />
      </div>

      {{-- Sección de ingredientes --}}
      <div x-show="tab === 'ingredientes' ">
        <div class="mb-6 flex justify-between">

          <h2 class="mb-6 text-3xl">Ingredientes</h2>
          {{-- Botón para añadir ingredientes --}}
          <div>
            <button x-on:click="appendIngrediente()"
              class="rounded bg-blue-500 py-1 px-2 capitalize text-blue-100 hover:bg-blue-800" type="button">
              {{ __('Añadir ingrediente') }}
            </button>
          </div>
        </div>
        <div id="ingredientes">
          @php
            $i = 1;
          @endphp
          @foreach ($receta->ingredientes as $ingrediente)
            <div x-data="{ showIngrediente_{{ $i }}: true }">
              <template x-if="showIngrediente_{{ $i }}">
                <div id="ingredientes_{{ $i }}" class="mb-4 grid grid-cols-12 gap-6 border-b pb-4"
                  x-data="{ selectedIngrediente_{{ $i }}: {{ $ingrediente->id }} }">
                  {{-- selector ingrediente --}}
                  <div class="col-span-3 flex flex-col">
                    <label for="ingrediente_{{ $i }}">Ingrediente<span
                        class="ml-2">(*)<span></label>
                    <select x-model.number="selectedIngrediente_{{ $i }}"
                      name="ingredientes[{{ $i }}][ingrediente]"
                      id="ingredientes_ingrediente_{{ $i }}"
                      class="bor borde mt-2 rounded border-gray-300 py-2 px-4">
                      <template x-for="ingrediente in ingredientesApi" :key="ingrediente.id">
                        <option :value="ingrediente.id" x-text="ingrediente.nombre"
                          :selected="ingrediente.id == selectedIngrediente_{{ $i }}"></option>
                      </template>
                    </select>
                  </div>

                  {{-- Cantidad --}}
                  <div class="col-span-1 flex flex-col">
                    <label for="ingredientes_cantidad_{{ $i }}">Cantidad<span
                        class="ml-2">(*)<span></label>
                    <input type="text" class="bor borde mt-2 rounded border-gray-300 py-2 px-4"
                      name="ingredientes[{{ $i }}][cantidad]"
                      id="ingredientes_cantidad_{{ $i }}"
                      value="{{ old('cantidad', $ingrediente->pivot->cantidad) }}" required>
                  </div>

                  {{-- Unidad --}}
                  <div class="col-span-2 flex flex-col">
                    <label for="unidad_{{ $i }}">Unidad<span class="ml-2">(*)<span></label>
                    <select name="ingredientes[{{ $i }}][unidad]"
                      id="ingredientes_unidad_{{ $i }}"
                      class="bor borde mt-2 rounded border-gray-300 py-2 px-4">
                      <template x-for="unidad in unidadesApi" :key="unidad.id">
                        <option :value="unidad.id" x-text="unidad.nombre"
                          :selected="unidad.id === {{ old('unidad_id', $ingrediente->pivot->unidad_id) }}"></option>
                      </template>
                    </select>
                  </div>
                  {{-- poder eliminar el ingrediente --}}
                  <div class="col-span-2 flex items-end">
                    <span x-on:click="showIngrediente_{{ $i }} = false"
                      class="cursor-pointer rounded border bg-red-400 py-1 px-4 text-red-100 hover:bg-red-900">Eliminar</span>
                  </div>
                </div>
              </template>
            </div>
            @php
              $i++;
            @endphp
          @endforeach
        </div>
      </div>

      {{-- Sección de Pasos --}}
      <div x-show="tab === 'pasos'">
        <div class="mb-6 flex justify-between">
          {{-- Título de la sección --}}
          <h2 class="mb-6 text-3xl">{{ __('Steps') }}</h2>
          {{-- Botón para añadir pasos --}}
          <div>
            <button x-on:click="appendPaso()"
              class="rounded bg-blue-500 py-1 px-2 capitalize text-blue-100 hover:bg-blue-800" type="button">
              {{ __('Añadir paso') }}
            </button>
          </div>
        </div>
        <x-recetas.pasos :pasos="$receta->pasos" />
      </div>

      {{-- Botón submit --}}
      <div class="my-10 text-right">
        <button x-on:click="guardaFormulario()"
          class="rounded bg-green-500 py-1 px-2 capitalize text-green-100 hover:bg-green-800">
          {{ __('update') }}
        </button>
      </div>

      {{-- Fin del formulario --}}
    </form>
  </div>

  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  {{-- Estilos para el editor que se cargará en el head de la página --}}
  @push('head')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  @endpush

  {{-- Javascrip que se cargará antes del cierre del body --}}
  @push('bottom')
    <!-- Alpine data -->
    <script>
      /* Javascrip Alpine para el formulario */
      function formulario() {
        return {
          /* Variables */
          tab: 'receta',
          selected: 1,
          ingredientesApi: [],
          unidadesApi: [],
          selectedIngrediente: null,
          active: 'active inline-block rounded-t-lg border-b-2 border-blue-600 py-4 px-4 text-center text-sm font-medium text-blue-600 dark:border-blue-500 dark:text-blue-500',
          not_active: 'inline-block rounded-t-lg border-b-2 border-transparent py-4 px-4 text-center text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300',

          /**
           * Función que crea un hidden con el id de la imagen que se elimina
           */
          borraImagen: (imagen) => {
            document.getElementById('contenedor-imagen-' + imagen).remove();
            let input = document.createElement('input');
            input.setAttribute('name', 'borrar_fotos[]');
            input.setAttribute('value', imagen);
            input.setAttribute('type', 'hidden');
            document.getElementById('recetaForm').appendChild(input);
          },
          /**
           * Función para el submit que pasa los datos del editor a su campo
           */
          guardaFormulario: () => {
            guardadescripcion();
            formulario.submit();
          },
          /**
           * Función que genera el código para un nuevo paso y lo inserta en el formulario
           */
          appendPaso: () => {
            let acordeon = document.getElementById('acordeon-pasos');
            let siguiente = acordeon.childElementCount + 1;
            this.selected = siguiente;
            let capa = document.createElement('li');
            capa.setAttribute('class', 'relative border-b border-gray-200');
            acordeon.appendChild(capa);
            capa.innerHTML = `
            <button type="button" class="w-full px-8 py-6 text-left" x-on:click="selected !== ${siguiente} ? selected = ${siguiente} : selected = null">
              <div class="flex items-center justify-between">
                  <span class="text-3xl font-bold text-primary-600">
                      Paso ${siguiente}
                  </span>
                  <x-svgs.chevron-down />
              </div>
            </button>
            <div class="relative max-h-0 overflow-hidden transition-all duration-700" style="max-height: 350px;" x-ref="container${siguiente}"
                x-bind:style="selected == ${siguiente} ? 'max-height: ' + $refs.container${siguiente}.scrollHeight + 'px' : ''">
                <div class="p-6">
                    <div class="grid grid-cols-12 gap-10">
                        <div class="col-span-3 flex flex-col">
                            <label for="pasos_${siguiente}_nombre" class="capitalize">name<span class="ml-1">(*)</span></label>
                            <input type="text" class="border-gray-300  mt-2 rounded-md border py-2 px-4" name=pasos[${siguiente}][nombre]" id="pasos_${siguiente}_nombre"
                                value="Paso ${siguiente}">
                        </div>
                        <div class="col-span-6 flex flex-col">
                            <label for="pasos_${siguiente}_descripcion">Descripción<span class="ml-1">(*)</span></label>
                            <textarea name="pasos[${siguiente}][descripcion]" id="pasos_${siguiente}_descripcion" class="border-gray-300  mt-2 rounded-md border py-2 px-4" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-span-3 flex flex-col">
                            <label for="pasos_${siguiente}_fotos">Fotos<span class="ml-1">(*)</span></label>
                            <input type="file" name="pasos[${siguiente}][]" class="border-gray-300  mt-2 rounded-md border py-2 px-4" id="fotos_${siguiente}_pasos">
                        </div>
                        <input type="hidden" name="pasos[${siguiente}][id]" value="0" />
                    </div>
                </div>
            </div>
          `;
          },
          appendIngrediente: () => {
            let ingredientes = document.getElementById('ingredientes');
            let siguiente = ingredientes.childElementCount + 1;
            this.selected = siguiente;
            let capa = document.createElement('div');
            capa.setAttribute('x-data', `{ showIngrediente_${siguiente}: true }`)
            ingredientes.appendChild(capa);
            capa.innerHTML = `
              <template x-if="showIngrediente_${siguiente}">
                <div id="ingredientes_${siguiente}" class="grid grid-cols-12 gap-6 mb-4 pb-4 border-b" x-data="{ selectedIngrediente_${siguiente}: null }">
                  {{-- selector ingrediente --}}
                  <div class="col-span-3 flex flex-col">
                    <label for="ingrediente_${siguiente}">Ingrediente<span class="ml-2">(*)<span></label>
                    <select x-model.number="selectedIngrediente_${siguiente}" name="ingredientes[${siguiente}][ingrediente]" id="ingredientes_ingrediente_${siguiente}"
                      class="bor borde mt-2 rounded border-gray-300 py-2 px-4">
                      <template x-for="ingrediente in ingredientesApi" :key="ingrediente.id">
                        <option :value="ingrediente.id" x-text="ingrediente.nombre"></option>
                      </template>
                    </select>
                  </div>

                  <div class="col-span-1 flex flex-col">
                    <label for="ingredientes_cantidad_${siguiente}">Cantidad<span class="ml-2">(*)<span></label>
                    <input type="text" class="bor borde mt-2 rounded border-gray-300 py-2 px-4"
                      name="ingredientes[${siguiente}][cantidad]" id="ingredientes_cantidad_${siguiente}"
                      value="" required>
                  </div>

                  <div class="col-span-2 flex flex-col">
                    <label for="unidad_${siguiente}">Unidad<span class="ml-2">(*)<span></label>
                    <select name="ingredientes[${siguiente}][unidad]" id="ingredientes_unidad_${siguiente}"
                      class="bor borde mt-2 rounded border-gray-300 py-2 px-4">
                      <template x-for="unidad in unidadesApi" :key="unidad.id">
                        <option :value="unidad.id" x-text="unidad.nombre""></option>
                      </template>
                    </select>
                  </div>
              
                <div class="col-span-2 flex items-end">
                  <span x-on:click="showIngrediente_${siguiente} = false" class="border rounded py-1 px-4 bg-red-400 text-red-100 hover:bg-red-900 cursor-pointer">Eliminar</span>
                </div>
              </template>
            `;
          },
          init() {
            fetch('/api/ingredientes').then(res => res.json()).then(res => {
              let empty = {
                id: '',
                nombre: '- Selecciona ingrediente -'
              };
              res.unshift(empty);
              this.ingredientesApi = res;
            });

            fetch('/api/unidades').then(res => res.json()).then(res => {
              let empty = {
                id: '',
                nombre: '- Selecciona unidad -'
              };
              res.unshift(empty);
              this.unidadesApi = res

              // Pensando en filtrar por tipo  de unidad
              /*               this.unidadesApi.peso = res.filter(unidad => unidad.categoria_id == 1);
                            this.unidadesApi.capacidad = res.filter(unidad => unidad.categoria_id == 2);
               */
            });
          }
        }
      }
    </script>
  @endpush

</x-app-layout>
