<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ __('edit') . ' ' . __('contact') }}
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
    <form action="{{ route('admin.contactos.update', $contacto) }}" id="contactoForm" method="post">
      @csrf
      @method('PATCH')

      <div class="mt-6 grid grid-cols-12 gap-6">
            {{-- Campo nombre --}}
            <div class="col-span-12 md:col-span-6">
                <div class="mb-4"><label for="nombre" class="w-full">{{ __('Name') }}</label></div>
                <div>
                    <input type="text" name="nombre" id="nombre" readonly="" class="w-full rounded border-gray-300 bg-primary-200 outline-none pointer-events-none"
                  value="{{ old('nombre', $contacto->nombre) }}">
                </div>
            </div>
            {{-- fin campo nombre --}}
            {{-- Campo email --}}
            <div class="col-span-12 md:col-span-6">
                <div class="mb-4"><label for="email" class="w-full">{{ __('Email') }}</label></div>
                <div>
                    <input type="text" name="email" id="email" readonly="" class="w-full rounded border-gray-300 bg-primary-200 outline-none pointer-events-none"
                  value="{{ old('email', $contacto->email) }}">
                </div>
            </div>
            {{-- fin campo email --}}
            {{-- Campo email --}}
            <div class="col-span-12">
                <div class="mb-4"><label for="asunto" class="w-full">{{ __('Subject') }}</label></div>
                <div>
                    <input type="text" name="asunto" id="asunto" readonly="" class="w-full rounded border-gray-300 bg-primary-200 outline-none pointer-events-none"
                  value="{{ old('asunto', $contacto->asunto) }}">
                </div>
            </div>
            {{-- fin campo email --}}
            {{-- Campo email --}}
            <div class="col-span-12">
                <div class="mb-4"><label for="contenido" class="w-full">{{ __('Message') }}</label></div>
                <div>
                    <textarea name="contenido" id="contenido" readonly="" class="w-full p-3 rounded border-gray-300 bg-primary-200 outline-none pointer-events-none">{{ old('contenido', $contacto->contenido) }}</textarea>
                </div>
            </div>
            {{-- fin campo email --}}

          </div>
      {{-- Botón submit --}}
      <div class="my-10 text-left">
        <a href="{{ route('admin.contactos.index') }}" class="rounded bg-red-500 py-1 px-2 capitalize text-red-100 hover:bg-red-800" >{{ __('close') }}</a>  
      </div>
    </form>
  </div>

</x-app-layout>