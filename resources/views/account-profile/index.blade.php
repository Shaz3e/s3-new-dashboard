@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Account Profile') }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Account Profile')]]" />

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            @include('account-profile.navbar')
            <div class="tab-content">
                <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab-1">
                    <div class="row">
                        <div class="col-lg-4 col-xxl-3">
                            @include('account-profile.profile')
                        </div>
                        <div class="col-lg-8 col-xxl-9">
                            @include('account-profile.profile-info')
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="personal-details" role="tabpanel" aria-labelledby="profile-tab-2">
                    @include('account-profile.personal-details')
                </div>
                <div class="tab-pane" id="change-password" role="tabpanel" aria-labelledby="profile-tab-3">
                    @include('account-profile.change-password')
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
