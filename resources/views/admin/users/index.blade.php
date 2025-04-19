@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Manage Users') }}" :breadcrumbs="[['url' => route('admin.dashboard'), 'label' => __('Dashboard')], ['label' => __('Users')]]" />

    @livewire('admin.users.users-list')
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
