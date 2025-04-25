@extends('components.layouts.app')

@section('content')
    <x-page-title title="Global Header & Footer List" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Global Header & Footer')]]" />

    @livewire('admin.email-templates.global-email-templates-list')
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
