@props([
    'type' => 'submit',
    'text' => 'Save',
    'class' => 'btn-outline-secondary',
    'name' => '',
])

<button type="{{ $type }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'btn  ' . $class]) }}>
    {{ $text }}
</button>
