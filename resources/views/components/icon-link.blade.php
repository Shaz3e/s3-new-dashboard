@props([
    'route' => '#',
    'permission' => null,
    'icon' => 'ti ti-eye', // No icon by default
    'class' => 'btn btn-link-secondary', // Default button class is btn-dark
])

@if (is_null($permission) || auth()->user()->can($permission))
    <a href="{{ $route }}" {{ $attributes->merge(['class' => 'avtar avtar-xs ' . $class]) }}>
        <i class="{{ $icon }} f-20"></i>
    </a>
@endif
