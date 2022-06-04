<footer class="text-white mt-10">
    <div class="bg-primary-900 py-4">
        <div class="container mx-auto px-4">
            <div class="border-b border-white pb-4">
                <x-svgs.logo-footer />
            </div>
            <div class="grid py-6 lg:grid-cols-8 grid-cols-2 gap-6">
                <div class="col-span-2 flex flex-col gap-2">
                    <h3 class="text-2xl">{{ __('You like to cook') }}</h3>
                    <a href="http://maikol.eu" target="_blank" class="hover:text-secondary-300">© Maikol Fustes</a>
                    <div class="flex flex-row gap-2">
                        <a href="#"><x-svgs.facebook class="h-8 w-8 hover:text-secondary-300"/></a>
                        <a href="#"><x-svgs.github class="h-8 w-8 hover:text-secondary-300" /></a>
                        <a href="#"><x-svgs.linkedin class="h-8 w-8 hover:text-secondary-300" /></a>
                    </div>
                </div>
                <div class="col-span-2 flex flex-col gap-2">
                    <h3 class="text-2xl">{{ __('Site Map') }}</h3>
                    <div class="flex flex-row gap-8">
                        <div class="flex flex-col">
                            <a href="{{ url('/') }}" class="hover:text-secondary-300 capitalize">{{ __('recipes') }}</a>
                        </div>
                        <div class="flex flex-col">
                            <a href="{{ url('/contact') }}" class="hover:text-secondary-300 capitalize">{{ __('contact') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-primary-500 flex flex-row justify-end pt-3">
                <a href="#" class="text-primary-300 hover:text-secondary-300">{{ __('Privacy policy') }}</a>
            </div>
        </div>
    </div>
</footer>
