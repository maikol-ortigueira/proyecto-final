@props(['paso', 'orden'])
<div>
  {{-- Paso --}}
  <div class="grid grid-cols-12 gap-10">
    {{-- Campo nombre --}}
    <div class="col-span-3 flex flex-col">
      <label for="pasos_{{ $orden }}_nombre" class="capitalize">Nombre<span class="ml-1">(*)</span></label>
      <input type="text"
        class="@error('nombre') border-red-300 @else border-gray-300 @enderror mt-2 rounded-md border py-2 px-4"
        name="pasos[{{ $orden }}][nombre]" id="pasos_{{ $orden }}_nombre" value="{{ old('nombre', $paso->nombre) }}">
      {{-- Captura el error si existe --}}
      @error('nombre')
        <span class="text-xs text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="col-span-6 flex flex-col">
        <label for="pasos_{{ $orden }}_descripcion">Descripción<span class="ml-1">(*)</span></label>
        <textarea name="pasos[{{ $orden }}][descripcion]" id="pasos_{{ $orden }}_descripcion" class="border-gray-300  mt-2 rounded-md border py-2 px-4" cols="30" rows="10">
            {!! old('descripcion', $paso->descripcion) !!}
        </textarea>
    </div>
    <div class="col-span-3 flex flex-col">
        <label for="pasos_{{ $orden }}_fotos">Fotos<span class="ml-1">(*)</span></label>
        <input type="file" name="pasos[{{ $orden }}][fotos][]" class="border-gray-300  mt-2 rounded-md border py-2 px-4" id="fotos_{{ $orden }}_pasos">
    </div>
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
</div>
