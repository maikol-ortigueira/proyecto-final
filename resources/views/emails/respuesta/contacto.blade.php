@component('mail::message')
# Correo de contacto

Hola **{{ $contacto->nombre }}**, gracias por contactar con nosotros.

Tu solicitud pasa ahora a nuestro equipo de recetucha, y atenderá a tu petición a la mayor brevedad posible.

Gracias de nuevo,<br>
{{ config('app.name') }}
@endcomponent
