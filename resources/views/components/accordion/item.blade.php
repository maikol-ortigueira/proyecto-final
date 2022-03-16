@props(['order', 'titulo'])
{{-- Genera cada uno de los items del acordeon --}}
<li class="relative border-b border-gray-200">
  <button type="button" class="w-full px-8 py-6 text-left"
    x-on:click="selected !== {{ $order }} ? selected = {{ $order }} : selected = null">
    <div class="flex items-center justify-between">
      <span class="text-3xl font-bold text-primary-600">
        {{ $titulo }}
      </span>
      <x-svgs.chevron-down />
    </div>
  </button>
  <div class="relative max-h-0 overflow-hidden transition-all duration-700" style="" x-ref="container{{ $order }}"
    x-bind:style="selected == {{ $order }} ? 'max-height: ' + $refs.container{{ $order }}.scrollHeight + 'px' : ''">
    <div class="p-6">
      {{ $slot }}
    </div>
  </div>
</li>
