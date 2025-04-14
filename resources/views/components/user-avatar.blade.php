@props([
    'user' => auth()->user(), // Defaults to authenticated user if no user is passed
    'class' => '',
])

@php
    $avatarPath = '';

    if ($user->profile && $user->profile->avatar) {
        if (str_contains($user->profile->avatar, 'avatars/avatar')) {
            // Predefined avatar stored in public/avatars/
            $avatarPath = asset($user->profile->avatar);
        } else {
            // Uploaded avatar stored in the storage directory
            $avatarPath = asset('storage/' . $user->profile->avatar);
        }
    } else {
        // Default fallback avatar
        $avatarPath = asset('avatars/avatar1.jpg');
    }
@endphp

<img src="{{ $avatarPath }}" {{ $attributes->merge(['class' => $class]) }} alt="{{ $user->name }}" />
