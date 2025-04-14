@props([
    'name',
    'options' => [], // Available options
    'label' => '', // Label for the select
    'placeholder' => 'Select an option', // Placeholder when nothing is selected
    'selected' => old($name, $selected), // Use old() to retain the value
    'required' => false,
    'class' => 'form-select', // CSS class for styling
    'select2' => false, // Add select2 support
    'help_text' => '',
    'multiple' => false, // Enable multiple selection
])
<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $name }}" class="{{ $class }}"
        {{ $required ? 'required' : '' }}
        {{ $multiple ? 'multiple' : '' }}>
        <option value="">{{ $label ?: $placeholder }}</option>
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" {{ (string) $selected === (string) $key ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    @if ($help_text)
        <small class="d-block text-muted">{{ $help_text }}</small>
    @endif
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
