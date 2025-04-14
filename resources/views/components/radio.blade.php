@props([
    'name',
    'options' => [],
    'label' => '',
    'selected' => '',
    'required' => false,
    'class' => '',
    'help_text' => '',
])

<div class="mb-3">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
    <div>
        @foreach ($options as $key => $option)
            <div class="form-check-inline">
                <input type="radio" name="{{ $name }}" id="{{ $name }}_{{ $key }}"
                    value="{{ $key }}" {{ $attributes->merge(['class' => 'form-check-input ' . $class]) }}
                    {{ $selected == $key ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
                <label for="{{ $name }}_{{ $key }}" class="form-check-label">{{ $option }}</label>
            </div>
        @endforeach
    </div>
    @if ($help_text)
        <small class="d-block text-muted">{{ $help_text }}</small>
    @endif
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
