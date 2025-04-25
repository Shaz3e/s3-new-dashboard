@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ 'Email Templates List' }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Email Templates')]]" />

    @livewire('admin.email-templates.email-templates-list')
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
