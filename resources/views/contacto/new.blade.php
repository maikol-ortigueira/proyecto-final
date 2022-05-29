<x-guest-layout>
    <section class="container mx-auto py-10">
        <h1 class="capitalize text-4xl font-bold mb-6">{{__('contact')}}</h1>
        <form action="">
            <div class="w-full gap-6 md:flex block">
                <div class="mb-4 w-full">
                    <label for="nombre" class="capitalize block mb-2 font-medium text-gray-700">
                        {{__('name')}}
                    </label>
                    <input type="text" name="nombre" id="nombre" class="rounded shadow appearance-none focus:shadow-outline leading-tight focus:outline-none border w-full">
                </div>
                <div class="mb-4 w-full">
                    <label for="email" class="capitalize block mb-2 font-medium text-gray-700">{{__('email')}}</label>
                    <input type="email" name="email" id="email" class="rounded shadow appearance-none focus:shadow-outline leading-tight focus:outline-none border w-full">
                </div>
            </div>
            <div class="mb-4">
                <label for="asunto">{{__('subject')}}</label>
                <input type="text" name="asunto" id="asunto">
            </div>
            <div class="mb-4">
                <label for="contenido">{{__('message')}}</label>
                <textarea name="contenido" id="contenido" cols="30" rows="10"></textarea>
            </div>
        </form>
        <div>

        </div>
    </section>
</x-guest-layout>