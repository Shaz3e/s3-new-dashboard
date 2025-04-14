@props([
    'permission' => null,
    'icon' => 'ti ti-eye', // No icon by default
    'class' => 'btn btn-link-secondary', // Default button class is btn-dark
])

@if (is_null($permission) || auth()->user()->can($permission))
    <button type="submit" {{ $attributes->merge(['class' => 'avtar avtar-xs ' . $class]) }} data-toggle="modal"
        data-target="#deleteModal">
        <i class="{{ $icon }} f-20"></i>
    </button>
@endif
