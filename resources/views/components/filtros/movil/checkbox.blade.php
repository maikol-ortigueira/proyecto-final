@props(['item', 'checked', 'form'])
<div class="flex items-center">
  <input 
  id="filter-size-5"
    x-on:change="buscarDeForm('filtros-movil')"
    name="{{ $form }}[]"
    value="{{ $item->id }}"
    type="checkbox"
    {{ $checked ?? '' ? ' checked' : '' }}
    class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
  <label for="filter-size-5" class="ml-3 min-w-0 flex-1 text-gray-500">
    {{ $item->nombre }}
  </label>
</div>
