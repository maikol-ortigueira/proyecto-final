@props(['items'])
<div x-data="{ open: false }" class="border-b border-gray-200 py-6">
  <h3 class="-my-3 flow-root">
    <button type="button" x-description="Expand/collapse section button"
      class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
      aria-controls="filter-section-2" x-on:click="open = !open" aria-expanded="false"
      x-bind:aria-expanded="open.toString()">
      <span class="font-medium capitalize text-gray-900">
        {{-- Título del filtro --}}
        {{ __($items->name) }}
      </span>
      <span class="ml-6 flex items-center">
        <x-svgs.solid-plus-sm x-show="!(open)" />
        <x-svgs.solid-minor-sm x-show="open" />
      </span>
    </button>
  </h3>
  <div class="pt-6" x-description="Filter section, show/hide based on section state." id="filter-section-2"
    x-show="open">
    <div class="space-y-4">
      {{-- Añadir los checkboxes --}}
      @foreach ($items as $item)
        <x-filtros.desktop.checkbox :item="$item" />
      @endforeach
    </div>
  </div>
</div>
