@props(['id', 'type' => 'text', 'value' => '', 'name' => ''])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm']) }}
>
