@props(['item', 'checked', 'form'])
<div class="flex items-center">
  <input 
    id="filter-size-5"
    x-on:change="buscarDeForm('filtros-desktop')"
    name="{{ $form }}[]"
    value="{{ $item->id }}"
    type="checkbox"
    {{ $checked ?? '' ? ' checked' : '' }}
    class="h-4 w-4 rounded border-gray-300 text-secondary-600 focus:ring-secondary-500">
  <label for="filter-size-5" class="ml-3 text-sm text-gray-600">
    {{ $item->nombre }}
  </label>
</div>
