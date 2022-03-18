<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <x-svgs.logo-footer />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name') . ' (*)'" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email') . ' (*)'" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password') . ' (*)'" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password') . ' (*)'" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            {{-- Domicilio --}}
            <div class="mt-4">
                <x-label for="domicilio" :value="__('Address')" />
                <x-input id="domicilio" class="block mt-1 w-full" 
                    type="text" 
                    name="perfil[domicilio]" 
                    :value="old('domicilio')" />
            </div>
            {{-- localidad --}}
            <div class="mt-4">
                <x-label for="localidad" :value="__('City')" />
                <x-input id="localidad" class="block mt-1 w-full" 
                    type="text" 
                    name="perfil[localidad]" 
                    :value="old('localidad')" />
            </div>
            {{-- Provincia --}}
            <div class="mt-4">
                <x-label for="provincia" :value="__('State')" />
                <x-input id="provincia" class="block mt-1 w-full" 
                    type="text" 
                    name="perfil[provincia]" 
                    :value="old('provincia')" />
            </div>
            {{-- código postal --}}
            <div class="grid grid-cols-6 mt-4 w-full gap-4">
                <div class="col-span-2 flex flex-col">
                    <x-label for="cp" :value="__('Zip Code')" />
                    <x-input id="cp" class="mt-1" 
                    type="text" 
                    name="perfil[cp]" 
                    :value="old('cp')" />
                </div>
                <div class="col-span-4 flex flex-col">
                    <x-label for="telefonos" :value="__('Phone number')" />
                    <x-input id="telefonos" class="mt-1" 
                    type="text" 
                    name="perfil[telefonos]" 
                    :value="old('telefonos')" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" value="Register" size="small" />
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
