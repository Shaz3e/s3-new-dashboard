@props([
    'record', // The model record
    'field', // The field to be toggled
    'onLabel' => __('Yes'), // Label for the "On" state
    'offLabel' => __('No'), // Label for the "Off" state
])

<div class="form-check form-switch custom-switch-v1">
    <input type="checkbox" wire:click="toggleStatus({{ $record->id }}, '{{ $field }}')"
        class="form-check-input input-success" id="{{ $field }}_{{ $record->id }}" switch="bool"
        {{ $record->{$field} ? 'checked' : '' }} />
    <label for="{{ $field }}_{{ $record->id }}" data-on-label="{{ $onLabel }}"
        data-off-label="{{ $offLabel }}"></label>
</div>
