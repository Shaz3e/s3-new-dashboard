@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ 'Roles' }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Roles')]]" />

    @livewire('admin.roles-permissions.roles.roles-list')
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
