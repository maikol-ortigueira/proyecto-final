<div class="border-primary-200 mb-8 border-b drop-shadow-md">
  <div class="container mx-auto py-2">
    <div class="grid grid-cols-6 items-center gap-3">
      <div class="logo">
        <div class="inline-block">
          <a href="{{ url('/') }}">
            <x-svgs.logo width="60" class="w-4" />
          </a>
        </div>
      </div>
      <div x-data="{open: false}" class="relative">
        <div x-on:click="open = !open" x-on:click.outside="open = false"
          class="w-36 inline-flex cursor-pointer justify-between rounded border py-1 px-3 pl-3">
          <span>
            @if (App::getLocale() == 'es')
              {{ __('spanish') }}
            @else
              {{ __('english') }}
            @endif
          </span>
          <x-svgs.chevron-down class="w-4" />
        </div>
        <template x-if="open">
          <div id="language-switcher"
            class="border-primary-100 absolute left-0 mt-4 w-32 rounded border bg-white pt-2 pb-4">
            <a href="{{ url('locale/es') }}"
              class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">{{ __('spanish') }}</a>
            <a href="{{ url('locale/en') }}"
              class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">{{ __('english') }}</a>
          </div>
        </template>
      </div>
      <div id="main-menu" class="col-span-3 flex gap-4">
        <a href="{{ url('/') }}" class="uppercase">{{ __('home') }}</a>
        <a href="{{ url('/recetas') }}" class="uppercase">{{ __('receipts') }}</a>
        <a href="{{ url('/contacto') }}" class="uppercase">{{ __('contact') }}</a>
      </div>
      @if (Route::has('login'))
        <div class="hidden sm:inline-block">
          @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Dashboard</a>
          @else
            <div class="relative" x-data="{open: false}">
              <p x-on:click="open = !open" x-on:click.outside="open = false" class="inline-flex cursor-pointer border hover:bg-primary-500 border-primary-300 p-1 rounded-3xl">
                <x-svgs.users class="hover:fill-white"/>
              </p>
              <template x-if="open">
                <div class="border-primary-100 absolute left-0 mt-4 w-32 rounded border bg-white pt-2 pb-4">
                  <a href="{{ route('login') }}"
                    class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">{{ __('Login') }}</a>
                  @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                      class="hover:bg-primary-300 block h-6 w-full pl-3 text-sm text-gray-700 hover:text-gray-100 dark:text-gray-500">Register</a>
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
