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

        <form method="POST" action="{{ route('perfil.update', $user) }}">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name') . ' (*)'" />

                <x-input id="name" class="block mt-1 w-full bg-gray-200" type="text" name="name" :value="old('name', $user->name)" required readonly />
            </div>

            {{-- Domicilio --}}
            <div class="mt-4">
                <x-label for="domicilio" :value="__('Address')" />
                <x-input id="domicilio" class="block mt-1 w-full" 
                    type="text" 
                    name="perfil[domicilio]"
                    autofocus
                    :value="old('domicilio', $user->perfil->domicilio)" />
            </div>
            {{-- localidad --}}
            <div class="mt-4">
                <x-label for="localidad" :value="__('City')" />
                <x-input id="localidad" class="block mt-1 w-full" 
                    type="text" 
                    name="perfil[localidad]" 
                    :value="old('localidad', $user->perfil->localidad)" />
            </div>
            {{-- Provincia --}}
            <div class="mt-4">
                <x-label for="provincia" :value="__('State')" />
                <x-input id="provincia" class="block mt-1 w-full" 
                    type="text" 
                    name="perfil[provincia]" 
                    :value="old('provincia', $user->perfil->provincia)" />
            </div>
            {{-- código postal --}}
            <div class="grid grid-cols-6 mt-4 w-full gap-4">
                <div class="col-span-2 flex flex-col">
                    <x-label for="cp" :value="__('Zip Code')" />
                    <x-input id="cp" class="mt-1" 
                    type="text" 
                    name="perfil[cp]" 
                    :value="old('cp', $user->perfil->cp)" />
                </div>
                <div class="col-span-4 flex flex-col">
                    <x-label for="telefonos" :value="__('Phone number')" />
                    <x-input id="telefonos" class="mt-1" 
                    type="text" 
                    name="perfil[telefonos]" 
                    :value="old('telefonos', $user->perfil->telefonos)" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button.link class="bg-red-500 text-red-100 hover:bg-red-800 border border-red-500" 
                    :link="url()->previous()"
                    value="Close" 
                    size="small" />
                <x-button class="ml-4" value="Save" size="small" />
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
