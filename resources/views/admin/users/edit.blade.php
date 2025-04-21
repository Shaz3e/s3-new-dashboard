@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Edit User') }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.users.index'), 'label' => __('Manage User')],
        ['label' => __('Edit User')],
    ]" />

    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">

            @include('admin.users.navbar')

            <div class="tab-content">

                @include('admin.users.profile')

                @include('admin.users.personal-details')

                @include('admin.users.password')

                @include('admin.users.role')

                {{-- @include('admin.users.email_logs') --}}
            </div>
            {{-- /.tab-content --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
