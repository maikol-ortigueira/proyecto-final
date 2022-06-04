<nav x-data="{ open: false }" class="bg-white fixed w-full h-20 shadow-lg">
  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 f flex justify-between">
        <!-- Logo -->
        <div class="flex shrink-0 items-center">
          <a href="{{ route('home') }}">
          <x-svgs.logo width="60" class="w-4" />
          </a>
        </div>

        <!-- Menú desktop -->
        <div class="hidden space-x-8 sm:ml-10 mt-4 sm:flex">
            {{-- Selector de idioma --}}
            <div x-data="{open: false}" class="relative">
                <div x-on:click="open = !open" x-on:click.outside="open = false"
                    class="hidden sm:inline-flex w-36 cursor-pointer justify-between rounded border py-1 px-3 pl-3">
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
            {{-- Menú principal --}}
            <a href="{{ url('/') }}" class="uppercase">{{ __('recipes') }}</a>
            <a href="{{ route('contacto.index') }}" class="uppercase">{{ __('contact') }}</a>
            {{-- Botón usuario --}}
            @if (Route::has('login'))
                <div class="hidden sm:inline-block">
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
                    </div>
                    @endauth
                </div>
                @endif            
            </div>
         <!-- Hamburger -->
      <div class="-mr-2 flex items-center sm:hidden justify-end">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
</div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pt-4 pb-1 bg-white">
        <div class="px-4 grid grid-cols-1 gap-3 text-right shadow-lg">
        {{-- Menú principal --}}
            <a href="{{ url('/') }}" class="uppercase">{{ __('recipes') }}</a>
            <a href="{{ route('contacto.index') }}" class="uppercase">{{ __('contact') }}</a>

            <div class="mt-3 space-y-1">
            <!-- Authentication -->
                @if (Route::has('login'))
                    @auth
                        <div class="pt-2 pb-4 grid gap-3">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <a href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                @else
                    <div class="pt-2 pb-4 grid gap-3">
                        <a href="{{ route('login') }}" class="uppercase">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="uppercase">{{ __('Register') }}</a>
                        @endif
                    </div>
                @endauth
            @endif
            </div>
        </div>

        </div>
    </div>

</nav>
