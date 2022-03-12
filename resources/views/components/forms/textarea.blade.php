@props(['field', 'label', 'placeholder', 'required' => false])
@php
// Comprobar si hay error
$class = $errors->has($field) ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400' : 'text-gray-900 bg-gray-50 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';

$class = 'block p-2.5 w-full text-sm rounded-lg border ' . $class;
@endphp
<label for="{{ $field }}"
    class="block mb-2 text-sm font-medium {{ $errors->has($field) ? 'text-red-700 dark:text-red-500' : 'text-gray-900 dark:text-gray-400' }}">{{ $label }}{{ $required ? '(*)' : '' }}</label>
<textarea
    id="{{ $field }}"
    name="{{ $field }}"
    rows="4"
    class="{{ $class }}"
    placeholder="{{ $placeholder ?? $label }}" {{ $required ? ' required' : '' }}>
        {{ $slot ?? old($field) }}
    </textarea>
@error($field)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{__('Oops!')}}</span> {{ $message }}!!
    </p>
@enderror