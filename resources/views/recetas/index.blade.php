<x-guest-layout>
    <div class="min-h-full">
        <div id="recetas-section-1" class="h-72">
            <div class="flex items-center h-full pl-10">
                <div class="w-1/3">
                    <h1 class="text-6xl text-primary-600">¿Que comemos esta semana?</h1>
                </div>
            </div>
        </div>
        <div class="container mt-10">
            <h2 class="mb-6 text-3xl text-secondary-700">{{ __('Last Receitps') }}</h2>
            <x-recetas.items :recetas="$recetas" />
        </div>
    </div>
</x-guest-layout>