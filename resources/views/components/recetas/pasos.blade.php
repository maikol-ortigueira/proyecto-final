@props(['pasos' => false])
{{-- Genera el código dentro de la pestaña pasos de una receta --}}
<div class="mx-auto border border-gray-200 bg-white">
  <ul class="shadow-box" id="acordeon-pasos">
    @php
      $order = 1;
    @endphp
    @if ($pasos)
      @foreach ($pasos as $item)
        {{-- Pasamos los campos de un paso al acordeon --}}
        <x-accordion.item order="{{ $order }}" titulo="{{ __($item->nombre) }} ">
          {{-- El código del paso --}}
          <x-recetas.paso :paso="$item" orden="{{ $order }}" />
        </x-accordion.item>
        @php
          $order++;
        @endphp
      @endforeach
    @endif
  </ul>
</div>
