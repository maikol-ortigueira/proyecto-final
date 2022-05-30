<div class="border-primary-200 border-b drop-shadow-md">
  <div class="container mx-auto py-2" x-data="{ movil: false }" x-on:keydown.window.escape="movil = false">
    <div class="grid items-center lg:grid-cols-6 px-4 gr grid-cols-3 gap-10">
      <div class="logo">
        <div class="inline-block">
          <a href="{{ url('/') }}">
            <x-svgs.logo width="60" class="w-4" />
          </a>
        </div>
      </div>

      {{-- Versión movil --}}
      <div x-show="movil" class="fixed inset-0 z-40 flex lg:hidden" aria-modal="true">
          {{-- overlay oscuro --}}
        <div x-show="movil" x-transition:enter="transition-opacity ease-linear duration-300"
          x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
          x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-25" x-on:click="movil = false"
          aria-hidden="true">
        </div>
        {{-- Panel lateral izquierdo --}}
        <div x-show="movil" x-transition:enter="transition ease-in-out duration-300 transform"
          x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
          x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
          x-transition:leave-end="translate-x-full"
          class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
          <div class="flex items-center justify-between px-4">
            <h2 class="text-lg font-medium capitalize text-gray-900">{{ __('filters') }}</h2>
            <button type="button"
              class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
              x-on:click="movil = false">
              <span class="sr-only">{{ __('Close menu') }}</span>
              <x-svgs.close-simbol />
            </button>
          </div>
          <!-- Filtros -->
          <form class="mt-4 border-t border-gray-200" method="post" action="#" id="filtros-movil">

          </form>
        </div>
      </div>

      {{-- Versión desktop --}}
      {{-- Selector de idioma --}}
      <div x-data="{open: false}" class="relative">
        <div x-on:click="open = !open" x-on:click.outside="open = false"
          class="hidden lg:inline-flex w-36 cursor-pointer justify-between rounded border py-1 px-3 pl-3">
          <span>
            @if (App::getLocale() == 'es')
              Español
            @else
              English
            @endif
          </span>
          <x-svgs.chevron-down class="w-4" />
        </div>
        <template x-if="open">
          <div id="language-switcher"
            class="border-primary-100 absolute left-0 mt-4 w-32 rounded border bg-white pt-2 pb-4">
            <a href="{{ url('locale/es') }}"
              class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">Español</a>
            <a href="{{ url('locale/en') }}"
              class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">English</a>
          </div>
        </template>
      </div>
      <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
          x-on:click="movil = true">
          <span class="sr-only capitalize">{{ __('filters') }}</span>
          <x-svgs.filter />
      </button>
      {{-- Menú principal --}}
      <div id="main-menu" class="col-span-3 gap-4 hidden lg:inline-flex">
        <a href="{{ url('/') }}" class="uppercase">{{ __('recipes') }}</a>
        {{-- <a href="{{ url('/contacto') }}" class="uppercase">{{ __('contact') }}</a> --}}

      </div>
      {{-- Botón usuario --}}
      @if (Route::has('login'))
        <div class="hidden lg:inline-block">
          @auth
            <div class="relative" x-data="{open: false}">
              <div class="inline-flex cursor-pointer items-center gap-2 text-sm" x-on:click="open = !open"
                x-on:click.outside="open = false">
                <p>
                  {{ auth()->user()->name }}
                </p>
                <x-svgs.chevron-down />
              </div>
              <template x-if="open">
                <div class="border-primary-100 absolute left-0 mt-4 w-48 rounded border bg-white pt-2 pb-4">
                  @auth
                    @if (auth()->user()->isAdmin())
                      <x-dropdown-link :href="route('admin.recetas.index')">
                        {{ __('Dashboard') }}
                      </x-dropdown-link>
                    @endif
                  @endauth
                  <x-dropdown-link :href="route('perfil.editar', auth()->user())" class="capitalize">
                    {{ __('profile') }}
                  </x-dropdown-link>
                  <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                      onclick="event.preventDefault(); this.closest('form').submit();">
                      {{ __('Log Out') }}
                    </x-dropdown-link>
                  </form>
                </div>
              </template>
            </div>
          @else
            <div class="relative" x-data="{open: false}">
              <p x-on:click="open = !open" x-on:click.outside="open = false"
                class="hover:bg-primary-500 border-primary-300 inline-flex cursor-pointer rounded-3xl border p-1">
                <x-svgs.users class="hover:fill-white" />
              </p>
              <template x-if="open">
                <div class="border-primary-100 absolute left-0 mt-4 w-32 rounded border bg-white pt-2 pb-4">
                  <a href="{{ route('login') }}"
                    class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">{{ __('Login') }}</a>
                  @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                      class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">{{ __('Register') }}</a>
                  @endif
                </div>
              </template>
            @endauth
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
