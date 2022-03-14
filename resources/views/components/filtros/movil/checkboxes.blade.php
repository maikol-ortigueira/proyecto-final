<div x-data="{ open: false }" class="border-t border-gray-200 px-4 py-6">
  <h3 class="-mx-2 -my-3 flow-root">
    <button 
        type="button"
        class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
        aria-controls="filter-section-mobile-0"
        x-on:click="open = !open"
        aria-expanded="false"
        x-bind:aria-expanded="open.toString()">
      <span class="font-medium text-gray-900">
        Color
      </span>
      <span class="ml-6 flex items-center">
        <x-svgs.solid-plus-sm x-show="!(open)" />
        <x-svgs.solid-minor-sm x-show="open" />
      </span>
    </button>
  </h3>
  <div 
    class="pt-6"
    id="filter-section-mobile-0"
    x-show="open">
    <div class="space-y-6">
        <x-filtros.movil.checkbox />
    </div>
  </div>
</div>
