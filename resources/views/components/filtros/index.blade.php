<div class="bg-white">
  <div x-data="filtros()" x-on:keydown.window.escape="open = false">

    {{-- Versión movil --}}
    <div x-show="open" class="fixed inset-0 z-40 flex lg:hidden" aria-modal="true">
        {{-- overlay oscuro --}}
      <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-25" x-on:click="open = false"
        aria-hidden="true">
      </div>
      {{-- Panel lateral izquierdo --}}
      <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
        <div class="flex items-center justify-between px-4">
          <h2 class="text-lg font-medium capitalize text-gray-900">{{ __('filters') }}</h2>
          <button type="button"
            class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
            x-on:click="open = false">
            <span class="sr-only">{{ __('Close menu') }}</span>
            <x-svgs.close-simbol />
          </button>
        </div>
        <!-- Filtros -->
        <form class="mt-4 border-t border-gray-200">
          <x-filtros.movil.checkboxes />
        </form>
      </div>
    </div>

    {{-- Versión desktop --}}
    <main class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="relative z-10 flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
        <h1 class="text-4xl font-extrabold capitalize tracking-tight">{{ __('recipes') }}</h1>
        <div class="flex items-center">
          {{-- des-comentar para mostrar filtro de ordenamiento --}}
          {{-- <x-forms.dropdown :items="$items" /> --}}
          {{-- Icono con filtro solo en versión movil --}}
          <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
            x-on:click="open = true">
            <span class="sr-only capitalize">{{ __('filters') }}</span>
            <x-svgs.filter />
          </button>

        </div>
      </div>

      <section aria-labelledby="products-heading" class="pt-6 pb-24">
        <h2 id="products-heading" class="sr-only capitalize">{{ __('recipes') }}</h2>

        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-6">
          <!-- Filtros -->
          <form class="hidden lg:block" method="post" action="#" id="filtrosForm">
            <x-filtros.desktop.checkboxes :items="$tag" form="tag" />
            <x-filtros.desktop.checkboxes :items="$categoria" form="categoria" />
            <div class="text-right mt-6">
              <x-button.index value="Search" type="button" size="small" x-on:click="getRecetas()" />
            </div>
          </form>

          <!-- Recetas -->
          <div class="lg:col-span-5">
            {{ $slot }}
            {{-- <!-- Replace with your content -->
            <div class="h-96 rounded-lg border-4 border-dashed border-gray-200 lg:h-full"></div>
            <!-- /End replace --> --}}
          </div>
        </div>
      </section>
    </main>
  </div>
</div>
<script>
  function filtros() {
    return {
      open: false,
      getRecetas: () => {
        console.log();
      }
    }
  }
</script>
