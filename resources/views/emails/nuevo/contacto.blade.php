@component('mail::message')
# Nuevo contacto

Hola Maikol,

**{{ $contacto->nombre }}** acaba de enviar a través del formulario del sitio una nueva solicitud.

Estos son los datos del usuario:

- **Correo electrónico:** {{ $contacto->email }}
- **Asunto:** {{ $contacto->asunto }}
- **Mensaje:** {{ $contacto->contenido }}

Que tengas un buen día,<br>
{{ config('app.name') }}
@endcomponent
