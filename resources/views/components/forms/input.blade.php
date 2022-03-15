@props(['field', 'label', 'valor', 'required' => false])
<input
    {{$attributes->merge([
        "type" => "text", 
        "class" => "py-2 px-4 mt-2 border rounded-md"        
        ])}}
        class="
        @error('{{ $field }}') 
            border-red-300 bg-red-100 
            @else border-gray-300 
        @enderror"
        name="{{ $field }}"
        id="{{ $field }}"
        value="{{ $valor }}"    
    >
@error('{{ $field }}')
    <span class="text-xs text-red-500">{{ $message }}</span>
@enderror
