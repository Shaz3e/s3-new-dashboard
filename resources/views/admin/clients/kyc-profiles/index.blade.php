@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('KYC Document') }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => '/', 'label' => __('Clients')],
        ['label' => __('KYC List')],
    ]" />

    @livewire('admin.client.kyc-profile-list')
@endsection

@push('styles')
    {{-- CSS here --}}
@endpush

@push('scripts')
    {{-- JS here --}}
@endpush
