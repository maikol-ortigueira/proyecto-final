<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ __('new') . ' ' . __('categoria') }}
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
    <form action="{{ route('admin.categorias.store') }}" id="categoriaForm" method="post">
      @csrf
      @method('POST')

      <div class="mt-6 grid grid-cols-12">
        {{-- columna izquierda --}}
        <div class="col-span-12 md:col-span-6">
          <div class="grid grid-cols-12 gap-4">
            {{-- Campo nombre --}}
            <div class="col-span-12 md:col-span-6">
              <div class="mb-4"><label for="nombre" class="w-full capitalize">{{ _('name') }}</label></div>
              <div><input type="text" name="nombre" id="nombre" class="w-full rounded border-gray-300" value=""></div>
              <div> {{-- Captura el error si existe --}}
                @error('nombre')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo nombre --}}
            {{-- Campo parent_id --}}
            <div class="col-span-12 md:col-span-3">
              <div class="mb-4"><label for="parent_id"
                  class="w-full">{{ _('Parent category') }}</label>
              </div>
              <div>

                <select name="parent_id" id="parent_id" class="form-select w-full rounded border-gray-300 py-2 pl-4">
                  <option value="">- {{ __('Select a parent') }} -</option>
                  @php
                    $subcategories = App\Models\Categoria::all();
                  @endphp
                  @foreach ($subcategories as $item)
                    <option value="{{ $item->id }}">
                      {{ $item->nombre }}</option>
                  @endforeach
                </select>
              </div>
              <div> {{-- Captura el error si existe --}}
                @error('parent_id')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo parent_id --}}
            {{-- Campo type --}}
            <div class="col-span-12 md:col-span-3">
              <div class="mb-4"><label for="type" class="w-full">{{ _('Type') }}</label>
              </div>
              <div>
                <select name="type" id="type" class="form-select w-full rounded border-gray-300 py-2 pl-4">
                  <option value="">- {{ __('Select a type') }} -</option>
                  @php
                    $types = [['value' => App\Models\Unidad::class, 'texto' => __('unit')], ['value' => App\Models\Receta::class, 'texto' => __('recipe')]];
                  @endphp
                  @foreach ($types as $item)
                    <option value="{{ $item['value'] }}">
                      {{ $item['texto'] }}</option>
                  @endforeach
                </select>
              </div>
              <div> {{-- Captura el error si existe --}}
                @error('type')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo type --}}

          </div>
        </div>
        {{-- columna derecha --}}
        <div class="col-span-12 md:col-span-6"></div>
      </div>
      {{-- Botón submit --}}
      <div class="my-10 flex gap-4">
        <a href="{{ route('admin.categorias.index') }}"
          class="rounded bg-red-500 py-1 px-2 capitalize text-red-100 hover:bg-red-800">{{ __('close') }}</a>
        <button class="rounded bg-green-500 py-1 px-2 capitalize text-green-100 hover:bg-green-800">
          {{ __('save') }}
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
