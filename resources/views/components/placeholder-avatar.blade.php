@props([
    'class' => '',
])

@php
    $avatarPath = asset('avatars/placeholder.jpg');
@endphp

<img src="{{ $avatarPath }}" {{ $attributes->merge(['class' => $class]) }} alt="{{ config('app.name') }}" />
