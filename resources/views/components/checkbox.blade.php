@props([
    'name',
    'value' => '',
    'label' => '',
    'checked' => false,
    'required' => false,
    'class' => '',
    'help_text' => '',
])
<div class="mb-3 form-check">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1" class="form-check-input"
        {{ $checked ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
    <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
