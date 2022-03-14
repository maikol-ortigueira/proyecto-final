@props(['label', 'field', 'placeholder', 'required' => false])
@php
$class = $errors->has($field) 
    ? 'mt-1 bg-red-50 border border-red-500 text-red-900 placeholder-red-700 block w-full shadow-sm sm:text-sm w-full focus:ring-red-500 focus:border-red-500 block' 
    : 'mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md';
@endphp
<div>
    <label for="{{ $field }}" class="text-sm block font-medium {{ $errors->has($field) ? 'text-red-700 dark:text-red-500' : 'text-gray-700' }}">
        {{ $label }}{{ $required ? '(*)' : '' }}
    </label>
    <input
        type="{{ $field }}"
        id="{{ $field }}"
        name="{{ $field }}"
        class="{{ $class }}"
        placeholder="{{ $placeholder ?? $label }}" {{ $required ? ' required' : '' }}
        {{ $attributes(['value' => old($field)]) }}>
    @error($field)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{__('Oops!')}}</span> {{ $message }}!!</p>
    @enderror
</div>
