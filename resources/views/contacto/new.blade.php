<x-guest-layout>
    @error('*')
        <div class="container mx-auto mt-10 rounded border-2 border-red-400 bg-red-200 py-5 px-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @enderror
    <section class="container mx-auto py-10 px-4">
        <h1 class="mb-6 text-4xl font-bold capitalize">{{ __('contact') }}</h1>
        <form action="{{ route('contacto.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="block w-full gap-6 md:flex">
                <div class="mb-4 w-full">
                    <label for="nombre" class="mb-2 block font-medium capitalize text-gray-700">
                        {{ __('name') }}
                    </label>
                    <input type="text" name="nombre" id="nombre"
                        class="focus:shadow-outline w-full appearance-none rounded border leading-tight shadow focus:outline-none"
                        placeholder="{{ __('Name') }}" value="{{ old('nombre') }}">
                </div>
                <div class="mb-4 w-full">
                    <label for="email"
                        class="mb-2 block font-medium capitalize text-gray-700">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email"
                        class="focus:shadow-outline w-full appearance-none rounded border leading-tight shadow focus:outline-none"
                        placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                </div>
            </div>
            <div class="mb-4">
                <label for="asunto"
                    class="mb-2 block font-medium capitalize text-gray-700">{{ __('subject') }}</label>
                <input type="text" name="asunto" id="asunto"
                    class="focus:shadow-outline w-full appearance-none rounded border leading-tight shadow focus:outline-none"
                    placeholder="{{ __('Subject') }}" value="{{ old('asunto') }}">
            </div>
            <div class="mb-4">
                <label for="contenido"
                    class="mb-2 block font-medium capitalize text-gray-700">{{ __('message') }}</label>
                <textarea name="contenido" id="contenido" cols="30" rows="10"
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-4 leading-tight shadow focus:outline-none"
                    placeholder="{{ __('Message') }}">{{ old('contenido') }}</textarea>
            </div>
            <div class="text-right pt-4">
                <button class="bg-primary-700 text-white px-4 py-2 ro rounded hover:bg-primary-300">
                    {{ __('Send') }}
                </button>
            </div>
        </form>
        <div>

        </div>
    </section>
</x-guest-layout>
