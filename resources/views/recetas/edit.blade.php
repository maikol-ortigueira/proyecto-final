<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Receta') }}
        </h2>
    </x-slot>

    {{-- controlamos la solicitud --}}
    @if (Route::currentRouteName() == 'recetas.create')
        @php
            $isNew = true;
        @endphp
    @else
        @php
            $isNew = false;
        @endphp
    @endif
    {{-- <x-section title="{{ $isNew ? 'Crear' : 'Editar' }} una receta"
        description='Formulario para {{ $isNew ? 'crear' : 'modificar' }} los datos de una receta' > --}}
    <section class="w-10/12 mx-auto mt-10 bg-white rounded-lg p-10">
        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ $isNew ? route('recetas.store') : route('recetas.update', $receta) }}" method="POST">
            @csrf
            @if ($isNew)
                @method('POST')
            @else
                @method('PATCH')
            @endif
            <x-forms.input field="nombre" label="Nombre" :value="$isNew ? '' : old('nombre', $receta->nombre)" />
            <x-forms.textarea field="descripcion" label="Descripción">
                {{ $isNew ? '' : old('descripcion', $receta->descripcion) }}</x-forms.textarea>
            {{-- <x-tags :etiquetas="$isNew ? 'null' : old('etiquetas', $artigo->etiquetas)" /> --}}
            <div class="text-right">
                <x-buttons.group>
                    @if ($isNew)
                        <x-buttons.index position="first" href="{{ route('recetas.index') }}">
                            <x-svgs.backspace />
                            {{ __('Close') }}
                        </x-buttons.index>
                    @else
                        <x-buttons.index position="first" href="{{ route('recetas.show', $receta) }}">
                            <x-svgs.backspace />
                            {{ __('Close') }}
                        </x-buttons.index>
                    @endif
                    <x-buttons.index position="last">
                        <x-svgs.save />
                        {{ __('Save') }}
                    </x-buttons.index>
                </x-buttons.group>
            </div>
            {{-- <input type="hidden" name="user_id" value="{{ old('user_id', $user_id ?? auth()->user()->id) }}"> --}}
        </form>
    </section>
    {{-- </x-section> --}}
</x-app-layout>
