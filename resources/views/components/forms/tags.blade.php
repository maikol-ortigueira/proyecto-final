@props(['etiquetas'])
@if ($etiquetas !== 'null')
  @php
    $etiquetas = $etiquetas->pluck('id')->toArray();
  @endphp
@else
  @php
    $etiquetas = [];
  @endphp
@endif
<!-- Change the size of the container "max-w-full", ideally to w-1/6-->
<div class="container mt-6 max-w-full font-sans text-base">

  <div class="m-auto flex w-full gap-4 overflow-hidden border border-gray-300 pb-4 shadow-lg bg-white py-2 rounded">
    <div class="flex flex-row items-baseline justify-around">
      <h1 class="mt-2 ml-3 text-lg underline">Etiquetas</h1>
    </div>
    <div class="grid grid-cols-8">
      @foreach (\App\Models\Etiqueta::all() as $etiqueta)
        <label class="custom-label mt-2 ml-3 flex">
          <div class="mr-2 flex h-6 w-6 items-center justify-center bg-white p-1 shadow">
            <input type="checkbox" name="etiquetas[]" class="hidden"
              {{ in_array($etiqueta->id, $etiquetas) ? 'checked' : '' }} value="{{ $etiqueta->id }}">
            <x-svgs.tags-check />
          </div>
          <span class="select-none"> {{ $etiqueta->nombre }}</span>
        </label>
      @endforeach
    </div>
  </div>

</div>

<style>
  .custom-label input:checked+svg {
    display: block !important;
  }

</style>
