@props([
    'type' => 'text',
    'name',
    'value' => '',
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'class' => '',
    'help_text' => '',
    'validation_message' => '',
    'pattern' => '',
    'max_length' => 255,
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}"
        {{ $attributes->merge(['class' => 'form-control ' . $class]) }} id="{{ $name }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif {{ $required ? 'required' : '' }}
        @if ($name) value="{{ old($name, $value) }}" @endif
        @if ($validation_message) data-bouncer-message="{{ $validation_message }}" @endif
        @if ($pattern) pattern="{{ $pattern }}" @endif maxlength="{{ $max_length }}">
    @if ($help_text)
        <small class="d-block text-muted">{{ $help_text }}</small>
    @endif
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
