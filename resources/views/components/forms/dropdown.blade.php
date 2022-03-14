@props(['items'])
<div 
    x-data="{open: false, activeIndex: -1}" 
    x-on:keydown.escape.stop="open = false"
    x-on:click.away="open = false"
    class="relative inline-block text-left">
  <div>
    <button type="button"
      class="group inline-flex justify-center text-sm font-medium capitalize text-gray-700 hover:text-gray-900"
      id="menu-button"
      x-ref="button"
      x-on:click="open = !open"
      x-on:keyup.space.prevent=""
      x-on:keydown.enter.prevent=""
      aria-expanded="false"
      aria-haspopup="true"
      x-on:keydown.arrow-up.prevent=""
      x-on:keydown.arrow-down.prevent="">
      {{ __($items->heading) }}
      <x-svgs.chevron-down class="-mr-1 ml-1 h-5 w-4 flex-shrink-0 text-gray-400 group-hover:text-gray-500" />
    </button>
  </div>


  <div x-show="open" 
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="absolute right-0 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
    x-ref="menu-items"
    role="menu"
    aria-orientation="vertical"
    aria-labelledby="menu-button"
    tabindex="-1"
    x-on:keydown.arrow-up.prevent=""
    x-on:keydown.arrow-down.prevent=""
    x-on:keydown.tab="open = false"
    x-on:keydown.enter.prevent="open = false;"
    x-on:keyup.space.prevent="open = false;">
    <div class="py-1" role="none">
        @foreach ($items as $item)
            @php
                $order = 0
            @endphp
            <x-forms.dropdown-item :item="$item" :order="$order"
            @php
                $order++
            @endphp
        @endforeach
    </div>
  </div>

</div>
