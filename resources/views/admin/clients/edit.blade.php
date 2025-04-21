@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Client Profile') }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.clients.index'), 'label' => __('Clients')],
        ['label' => __('Edit Client')],
    ]" />

    <div class="row">
        {{-- Client Cover --}}
        <div class="col-sm-12">
            <div class="card social-profile">
                <img src="../assets/images/application/img-profile-cover.jpg" alt="" class="w-100 card-img-top" />
                <div class="card-body pt-0">
                    <div class="row align-items-end">
                        <div class="col-md-auto text-md-start">
                            <x-user-avatar :user="$client" class="img-fluid img-profile-avtar"
                                alt="{{ $client->name }}" />
                        </div>
                        <div class="col">
                            <div class="row justify-content-between align-items-end">
                                <div class="col-md-auto soc-profile-data">
                                    <h5 class="mb-1">{{ $client->name }}</h5>
                                    <p class="mb-0">
                                        Username: {{ $client->username }}
                                    </p>
                                </div>
                                <div class="col-md-auto">
                                    <x-action-link text="Login As Client" class="btn btn-outline-success"
                                        :route="route('admin.login.as.client', $client->id)" />

                                    @if ($client->email_verified_at)
                                        <x-action-link text="Mark Email As Not Verified" class="btn btn-outline-danger"
                                            :route="route('admin.clients.show', [
                                                'client' => $client,
                                                'verified' => 0,
                                            ])" permission="clients.update" />
                                    @else
                                        <x-action-link text="Mark Email As Verified" class="btn btn-outline-success"
                                            :route="route('admin.clients.show', [
                                                'client' => $client,
                                                'verified' => 1,
                                            ])" permission="clients.update" />
                                    @endif

                                    @if ($client->is_suspended)
                                        <x-action-link text="Unsuspend Client" class="btn btn-outline-success"
                                            :route="route('admin.clients.show', [
                                                'client' => $client,
                                                'suspended' => 0,
                                            ])" permission="clients.update" />
                                    @else
                                        <x-action-link text="Suspend Client" class="btn btn-outline-danger"
                                            :route="route('admin.clients.show', [
                                                'client' => $client,
                                                'suspended' => 1,
                                            ])" permission="clients.update" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /.col --}}

        {{-- Client Profile --}}
        <div class="col-sm-12">

            @include('admin.clients.navbar')

            <div class="tab-content">

                @include('admin.clients.profile')

                @include('admin.clients.personal-details')

                @include('admin.clients.password')

            </div>
            {{-- /.tab-content --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
    {{-- CSS here --}}
@endpush

@push('scripts')
    {{-- JS here --}}
@endpush
