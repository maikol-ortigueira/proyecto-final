@props(['order'])
<li class="relative border-b border-gray-200">
  <button type="button" class="w-full px-8 py-6 text-left"
    x-on="selected !== {{ $order }} ? selected = {{ $order }} : selected = null">
    <div class="flex items-center justify-between">
      <span>
        Should I use reCAPTCHA v2 or v3? </span>
      <span class="ico-plus"></span>
    </div>
  </button>
  <div class="relative max-h-0 overflow-hidden transition-all duration-700" style="" x-ref="container{{ $order }}"
    x-bind:style="selected == {{ $order }} ? 'max-height: ' + $refs.container{{ $order }}.scrollHeight + 'px' : ''">
    <div class="p-6">
      {{ $slot }}
    </div>
  </div>
</li>
