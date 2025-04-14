@props([
    'route' => '', // Default route name
    'method' => 'POST',
    'class' => '',
    'routeParams' => [], // Route parameters Use :routeParams="['param' => $value]"
    'enctype' => false,
])

@php
    // Determine if the user is an admin and apply the appropriate prefix
    $prefix = auth()->user()->is_admin == 1 ? 'admin.' : 'client.';
    $action = route($prefix . $route, $routeParams); // Builds route based on the user's role
@endphp

<form action="{{ $action }}" method="{{ strtoupper($method) }}" {{ $attributes->merge(['class' => ' ' . $class]) }}
    {{ $enctype ? 'enctype=multipart/form-data' : '' }} data-validate>
    @csrf
    {{ $slot }}
</form>
