@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Clients') }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Client List')]]" />

    @livewire('admin.clients.clients-list')
@endsection

@push('styles')
    {{-- CSS here --}}
@endpush

@push('scripts')
    {{-- JS here --}}
@endpush
