@props(['paso', 'orden'])
<div>
  {{-- Paso --}}
  <div class="grid grid-cols-6">
    {{-- Campo nombre --}}
    <div class="col-span-3 flex flex-col">
      <label for="nombre" class="capitalize">{{ __('name') }}<span class="ml-1">(*)</span></label>
      <input type="text"
        class="@error('nombre') border-red-300 @else border-gray-300 @enderror mt-2 rounded-md border py-2 px-4"
        name="nombre" id="nombre" value="{{ old('nombre', $paso->nombre) }}">
      {{-- Captura el error si existe --}}
      @error('raciones')
        <span class="text-xs text-red-500">{{ $message }}</span>
      @enderror
    </div>
  </div>
  {{-- Editor de texto --}}
  <div class="mt-10">
    <div id="editor" class="h-48 min-h-0 bg-white">{!! old('descripcion', $paso->descripcion) !!}</div>
  </div>
  {{-- imagenes --}}
  <div class="my-10 grid grid-cols-4">
    @foreach ($paso->fotos as $foto)
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
  <x-forms.label name="fotos[paso-{{ $orden }}]" label="add photos" field="fotos" />
  <x-forms.drag-and-drop-file name="fotos" />
</div>
