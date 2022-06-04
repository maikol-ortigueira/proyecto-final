<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ __('edit') . ' ' . __('user') }}
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
    <form action="{{ route('admin.users.update', $user) }}" id="rolForm" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mt-6 grid grid-cols-12 gap-10">
        {{-- columna izquierda --}}
        <div class="col-span-12 md:col-span-4">
          <div class="grid grid-cols-12 gap-4">
            {{-- Campo name --}}
            <div class="col-span-12">
              <div class="mb-4"><label for="name" class="w-full capitalize">{{ __('name') }}</label></div>
              <div><input type="text" name="name" id="name" class="w-full rounded border-gray-300"
                  value="{{ old('name', $user->name) }}"></div>
              <div> {{-- Captura el error si existe --}}
                @error('name')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo name --}}
            {{-- Campo roles --}}
            <div class="col-span-12 md:col-span-6">
              <div class="mb-4 text-xl font-bold capitalize">{{ __('roles') }}</div>
              {{-- roles del usuario --}}
              <div class="flex flex-col">
                @foreach ($user->roles as $rol)
                @php
                      $roles[] = $rol->id;
                      @endphp
                @endforeach
                @foreach (\App\Models\Rol::all() as $rol)
                <div>
                  <input type="checkbox" name="roles[]" id="{{ $rol->nombre }}" @if (in_array($rol->id, $roles))
                  {{ 'checked' }}
                  @endif
                  class="" value="{{ $rol->id }}"> <label for="{{ $rol->nombre }}" class="ml-2 capitalize">{{ $rol->nombre }}</label>
                </div>
                @endforeach
              </div>
              <div> {{-- Captura el error si existe --}} @error('roles')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo roles --}}
          </div>
        </div>
        {{-- columna derecha --}}
        <div class="col-span-12 md:col-span-8">
          <div class="grid grid-cols-12 gap-4">
            {{-- Campo domicilio --}}
            <div class="col-span-12">
              <div class="mb-4">
                <label for="domicilio" class="w-full">
                  {{ __('Address') }}
                </label>
              </div>
              <div>
                <input type="text" name="perfil[domicilio]" id="domicilio" class="w-full rounded border-gray-300"
                  value="{{ old('domicilio', $user->perfil->domicilio) }}">
              </div>
              <div> {{-- Captura el error si existe --}}
                @error('domicilio')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo domicilio --}}
            {{-- Campo localidad --}}
            <div class="col-span-12 md:col-span-4">
              <div class="mb-4"><label for="localidad" class="w-full">{{ __('City') }}</label>
              </div>
              <div><input type="text" name="perfil[localidad]" id="localidad" class="w-full rounded border-gray-300"
                  value="{{ old('localidad', $user->perfil->localidad) }}"></div>
              <div> {{-- Captura el error si existe --}}
                @error('localidad')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo localidad --}}
            {{-- Campo cp --}}
            <div class="col-span-12 md:col-span-2">
              <div class="mb-4"><label for="cp" class="w-full">{{ __('Zip Code') }}</label>
              </div>
              <div><input type="text" name="perfil[cp]" id="cp" class="w-full rounded border-gray-300"
                  value="{{ old('cp', $user->perfil->cp) }}"></div>
              <div> {{-- Captura el error si existe --}}
                @error('cp')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo cp --}}
            {{-- Campo provincia --}}
            <div class="col-span-12 md:col-span-4">
              <div class="mb-4"><label for="provincia" class="w-full">{{ __('State') }}</label>
              </div>
              <div><input type="text" name="perfil[provincia]" id="provincia" class="w-full rounded border-gray-300"
                  value="{{ old('provincia', $user->perfil->provincia) }}"></div>
              <div> {{-- Captura el error si existe --}}
                @error('provincia')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo provincia --}}
            {{-- Campo telefonos --}}
            <div class="col-span-12 md:col-span-2">
              <div class="mb-4"><label for="telefonos"
                  class="w-full">{{ __('Phone number') }}</label>
              </div>
              <div><input type="text" name="perfil[telefonos]" id="telefonos" class="w-full rounded border-gray-300"
                  value="{{ old('telefonos', $user->perfil->telefonos) }}"></div>
              <div> {{-- Captura el error si existe --}}
                @error('telefonos')
                  <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- fin campo telefonos --}}
          </div>
        </div>
      </div>
      {{-- Botón submit --}}
      <div class="my-10 text-right">
        <a href="{{ route('admin.users.index') }}"
          class="rounded bg-red-500 py-1 px-2 capitalize text-red-100 hover:bg-red-800">{{ __('close') }}</a>
        <button class="rounded bg-green-500 py-1 px-2 capitalize text-green-100 hover:bg-green-800">
          {{ __('update') }}
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
