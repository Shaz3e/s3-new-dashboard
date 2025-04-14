@props([
    'name' => 'file',
    'label' => '',
    'multiple' => false,
    'accept' => 'image/jpeg,image/png', // Accept only JPEG and PNG by default
    'required' => false,
    'maxSize' => '2MB',
    'help_text' => '',
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <div class="input-group">
        <input type="file" name="{{ $name }}" id="{{ $name }}" class="form-control"
            {{ $multiple ? 'multiple' : '' }} accept="{{ $accept }}" {{ $required ? 'required' : '' }}>
    </div>
    <small class="d-block text-muted">{{ $help_text }}</small>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
