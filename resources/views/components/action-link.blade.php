@props([
    'route' => '#',
    'permission' => null,
    'text' => __('Link'),
    'icon' => '', // No icon by default
    'iconPosition' => 'left', // Can be 'left', 'right', or 'none'
    'class' => 'btn-outline-secondary', // Default button class is btn-dark
])

@if (is_null($permission) || auth()->user()->can($permission))
    <a href="{{ $route }}" {{ $attributes->merge(['class' => 'btn ' . $class]) }}>
        {{-- Render Left Icon --}}
        @if ($icon && $iconPosition === 'left')
            <i class="{{ $icon }} me-1"></i>
        @endif

        {{-- Button Text --}}
        {{ $text }}

        {{-- Render Right Icon --}}
        @if ($icon && $iconPosition === 'right')
            <i class="{{ $icon }} me-1"></i>
        @endif
    </a>
@endif
