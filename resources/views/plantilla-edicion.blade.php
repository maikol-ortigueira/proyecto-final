<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ __('edit') . ' ' . __('ingrediente') }}
    </h2>
  </x-slot>

  @error('*')
    <div class="container mx-auto mt-10 rounded border-2 border-red-400 bg-red-200 py-5 px-4">
      <ul>
        @foreach ($errors->all() as $error)
          <li class="text-red-100">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @enderror

  <div class="container m-auto py-6">
    {{-- Formulario --}}
    <form action="{{ route('admin.ingredientes.update', $ingrediente) }}" id="ingredienteForm" method="post"
      enctype="multipart/form-data" x-data="formulario()" x-init="init()">
      @csrf
      @method('PATCH')

      <div class="grid grid-cols-12">
        {{-- columna izquierda --}}
        <div class="col-span-12 md:col-span-6">
            <div class="grid grid-cols-12">
              <div class="col-span-12 md:col-span-6">
                <div class="mb-4"><label for="nombre" class="w-full">{{ _('name') }}</label></div>
                <div><input type="text" name="nombre" id="nombre" class="w-full rounded border-gray-300"
                    value="{{ old('nombre', $ingrediente->nombre) }}"></div>
                <div> {{-- Captura el error si existe --}}
                  @error('nombre')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        {{-- columna derecha --}}
        <div class="col-span-12 md:col-span-6"></div>
      </div>
    </form>
  </div>

  {{-- Javascrip que se cargará antes del cierre del body --}}
  @push('bottom')
    <!-- Alpine data -->
    <script>
      /* Javascrip Alpine para el formulario */
      function formulario() {
        return {
          open: true,
          init: () => {},
        }
      }
    </script>
  @endpush
</x-app-layout>
