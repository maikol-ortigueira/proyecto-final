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
            <div class="grid grid-cols-6">
                <div class="flex flex-col col-span-3">
                    <label for="nombre" class="capitalize">{{ __('name') }}<span
                            class="ml-1">(*)</span></label>
                    <input type="text" class="py-2 px-4 mt-2 border rounded-md border-gray-300" name="nombre" id="nombre"
                        value="{{ old('nombre', $receta->nombre) }}">
                </div>
            </div>
            {{-- Editor de texto --}}
            <div class="mt-10">
                <div id="editor" class="bg-white h-48 min-h-0">{{ old('descripcion', $receta->descripcion) }}</div>
            </div>
            {{-- imagenes --}}
            <div class="grid grid-cols-4 my-10">
                @foreach ($receta->fotos as $foto)
                    <div id="contenedor-imagen-{{ $foto->id }}">
                        <div class="relative w-64 h-64 mx-auto">
                            <img src="{{ $foto->url }}" class="w-full h-64">
                            <x-svgs.close-simbol
                                class="absolute top-1 right-1 bg-white cursor-pointer h-10 w-10 p-2 rounded-3xl"
                                x-on:click="borraImagen({{ $foto->id }})" />
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- subida de nuevas imágenes --}}
            <x-forms.drag-and-drop-file name="fotos" />
            <x-button value="Update" type="button" x-on:click="guardaFormulario()" :secondary="true" />
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
