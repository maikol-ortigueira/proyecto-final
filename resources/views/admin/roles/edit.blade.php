<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ __('edit') . ' ' . __('role') }}
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
    <form action="{{ route('admin.roles.update', $rol) }}" id="rolForm" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mt-6 grid grid-cols-12">
        {{-- columna izquierda --}}
        <div class="col-span-12 md:col-span-6">
          <div class="grid grid-cols-12 gap-4">
            {{-- Campo nombre --}}
            <div class="col-span-12 md:col-span-6">
              <div class="mb-4"><label for="nombre" class="w-full">{{ _('name') }}</label></div>
              @php
                $protected = ['superadmin', 'editor', 'registrado'];
              @endphp
              <div><input type="text" name="nombre" id="nombre"
                  @if (in_array(old('nombre', $rol->nombre), $protected)) {{ 'readonly' }}
                    class="w-full rounded border-gray-300 bg-gray-200"
                    @else
                    class="w-full rounded border-gray-300" @endif
                  value="{{ old('nombre', $rol->nombre) }}"></div>
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
        <a href="{{ route('admin.roles.index') }}"
          class="rounded bg-red-500 py-1 px-2 capitalize text-red-100 hover:bg-red-800">{{ __('close') }}</a>
        @if (!in_array(old('nombre', $rol->nombre), $protected))
          <button class="rounded bg-green-500 py-1 px-2 capitalize text-green-100 hover:bg-green-800">
            {{ __('update') }}
          </button>
        @endif
      </div>
    </form>
  </div>
</x-app-layout>
