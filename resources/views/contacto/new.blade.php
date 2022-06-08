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
        <form action="{{ route('contacto.store') }}" method="post" id="contact-form">
            @csrf
            @method('POST')

            <div class="block w-full gap-6 md:flex">
                <div class="mb-4 w-full">
                    <label for="nombre" class="mb-2 block font-medium capitalize text-gray-700">
                        {{ __('name') }}
                    </label>
                    <input type="text" name="nombre" id="nombre"
                        class="focus:shadow-outline w-full appearance-none rounded border leading-tight shadow focus:outline-none validate-simbolosraros"
                        placeholder="{{ __('Name') }}" value="{{ old('nombre') }}">
                    <p class="message text-red-600"></p>
                </div>
                <div class="mb-4 w-full">
                    <label for="email"
                        class="mb-2 block font-medium capitalize text-gray-700">{{ __('Email') }} *</label>
                    <input type="email" name="email" id="email"
                        class="focus:shadow-outline w-full appearance-none rounded border leading-tight shadow focus:outline-none required validate-email"
                        placeholder="{{ __('Email') }}" value="{{ old('email') }}"
                        aria-required="true"
                    >
                    <p class="message text-red-600"></p>
                </div>
            </div>
            <div class="mb-4">
                <label for="asunto"
                    class="mb-2 block font-medium capitalize text-gray-700">{{ __('subject') }} *</label>
                <input type="text" name="asunto" id="asunto"
                    class="focus:shadow-outline w-full appearance-none rounded border leading-tight shadow focus:outline-none validate-simbolosraros required"
                    placeholder="{{ __('Subject') }}" value="{{ old('asunto') }}">
                <p class="message text-red-600"></p>
            </div>
            <div class="mb-4">
                <label for="contenido"
                    class="mb-2 block font-medium capitalize text-gray-700">{{ __('message') }} *</label>
                <textarea name="contenido" id="contenido" cols="30" rows="10"
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-4 leading-tight shadow focus:outline-none validate-simbolosraros required"
                    placeholder="{{ __('Message') }}">{{ old('contenido') }}</textarea>
                <p class="message"></p>
            </div>
            <div class="mx-1.5">
                <p>{{ __('Fields with * are required') }}</p>
            </div>
            <div class="text-right pt-4">
                <button id="btn_submit" type="button" onclick="validaTodo()" class="bg-green-800 text-white px-4 py-2 ro rounded hover:bg-primary-300">
                    {{ __('Send') }}
                </button>
            </div>
        </form>
        <div>

        </div>
    </section>
    @push('bottom')
    {{--javascript validaciones formulario--}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                validate_ctrls();
            })

            function validate_ctrls() {
                let btn = document.getElementById('btn_submit');
                let validate = document.querySelectorAll('[class*=validate]')
                let requerido = document.querySelectorAll('[class*=required]')

                Array.from(validate).forEach(function (v) {
                    let campoMensaje = v.parentElement.querySelector('.message')

                    v.addEventListener('focus', function () {
                        v.classList.remove('bg-red-100')
                        campoMensaje.textContent = '';
                    })

                    v.addEventListener('blur', function() {
                        if (v.classList.contains('validate-simbolosraros')) {
                            error = validaSimbolosRaros(v)

                            if (error !== false) {
                                v.classList.add('bg-red-100')
                                campoMensaje.textContent = error
                            }
                        }
                        if (v.classList.contains('validate-email')) {
                            error = validaEmail(v)

                            if (error !== false) {
                                v.classList.add('bg-red-100')
                                campoMensaje.textContent = error
                            }
                        }
                    })

                })

                Array.from(requerido).forEach(function(r) {
                    let campoMensaje = r.parentElement.querySelector('.message')

                    r.addEventListener('focus', function () {
                        r.classList.remove('bg-red-100')
                        campoMensaje.textContent = ''
                    })

                    r.addEventListener('blur', function() {
                        error = validaRequeridos(r)

                        if (error !== false) {
                            r.classList.add('bg-red-100')
                            campoMensaje.textContent = error
                        }
                    })
                })
            }

            function validaSimbolosRaros(campo) {
                var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

                let texto = campo.value
                let novalido = regex.test(texto)

                return novalido ? 'Solo se permiten cifras y letras en este campo' : novalido;
            }

            function validaEmail(campo, campoMensaje) {
                var validEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

                let texto = campo.value
                let novalido = validEmail.test(texto)

                return novalido ? false : 'Debes indicar una dirección de correo válida';
            }

            function validaRequeridos(campo) {
                let texto = campo.value
                var campoMensaje = campo.parentElement.querySelector('.message')
                novalido = texto === "";

                return texto === "" ? 'Este campo es requerido, no puede quedar vacío' : false;
            }

            function validaTodo() {
                let validate = document.querySelectorAll('[class*=validate]')
                let requerido = document.querySelectorAll('[class*=required]')

                let errores = 0

                Array.from(validate).forEach(function (v) {
                    if (v.classList.contains('validate-simbolosraros')) {
                        error = validaSimbolosRaros(v)
                        if (error !== false)
                            errores++
                    }
                    if (v.classList.contains('validate-email')) {
                        error = validaEmail(v)
                        if (error !== false) {
                            errores++
                        }
                    }
                });

                Array.from(requerido).forEach(function (r) {
                    error = validaRequeridos(r);
                    if (error !== false) {
                        errores++
                    }
                })

                if (errores > 0) {
                    alert('Hay campos no válidos en el formulario')
                } else {
                    document.getElementById('contact-form').submit()
                }
            }
        </script>
    @endpush
</x-guest-layout>
