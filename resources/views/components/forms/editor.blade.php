@props(['editor', 'content', 'formname'])
{{-- Para que funcione y evitar duplicidades se deberá copiar y pegar 
    en el fondo de la página principal el siguiente código descomentado
    debes colocarlo antes del @push('bottom') --}}

{{--  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> 
  @push('head')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  @endpush
 --}}

 {{-- Para que se guarden los datos debes añadir la función guarda[nombre_del_editor] antes del submit --}}
 {{-- Ejemplo: Para un editor que se llame descripcion sería: guardadescripcion(); formulario.submit() --}}

{{-- Editor de texto --}}
<div class="mt-10">
  <div id="{{ $editor }}" class="h-48 min-h-0 bg-white">{!! $content !!}</div>
</div>

@push('bottom')
  <!-- Include the Quill library -->
  <script>
    var {{ $editor }} = new Quill('#{{ $editor }}', {
      theme: 'snow'
    });

    function guarda{{ $editor }}() {
      formulario = document.getElementById('{{ $formname }}');
      let input = document.createElement('input');
      input.setAttribute('name', '{{ $editor }}');
      input.setAttribute('value', {{ $editor }}.root.innerHTML);
      input.setAttribute('type', 'hidden')
      formulario.appendChild(input);
    }
  </script>
@endpush
