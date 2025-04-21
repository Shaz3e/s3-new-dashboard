@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Manage User') }}" :breadcrumbs="[['url' => route('admin.dashboard'), 'label' => __('Dashboard')], ['label' => __('User List')]]" />

    @livewire('admin.users.users-list')
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
