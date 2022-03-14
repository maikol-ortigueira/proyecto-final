<x-guest-layout>
    <div class="min-h-full">
        <div id="recetas-section-1" class="h-72">
            <div class="flex items-center h-full pl-24">
                <div class="w-1/3">
                    <h1 class="font-bold text-6xl text-primary-600">{{ __('What do we eat this week?') }}</h1>
                </div>
            </div>
        </div>
        <div class="container mt-10 mx-auto">
            {{-- <h2 class="mb-6 text-3xl text-secondary-700">{{ __('Last Recipes') }}</h2> --}}
            <x-filtros.index>
                {{-- <x-recetas.items :recetas="$recetas" /> --}}
                <x-recetas.cards :recetas="$recetas" />
            </x-filtros.index>
        </div>
        <div class="container mx-auto">
            {{ $recetas->links() }}
        </div>
    </div>
</x-guest-layout>