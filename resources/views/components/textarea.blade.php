@props([
    'name',
    'value' => '',
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'rows' => 3,
    'class' => 'form-control',
    'help_text' => '',
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" rows="{{ $rows }}"
        class="{{ $class }}" {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
    <small class="d-block text-muted">{{ $help_text }}</small>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
