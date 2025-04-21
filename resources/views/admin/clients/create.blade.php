@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Create New Client') }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.clients.index'), 'label' => __('Clients')],
        ['label' => __('Create Client')],
    ]" />

    <form action="{{ route('admin.clients.store') }}" method="POST" data-validate>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="text" label="{{ __('First Name') }}" name="first_name" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="text" label="{{ __('Last Name') }}" name="last_name" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="email" label="{{ __('Email') }}" name="email" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="password" label="{{ __('Password') }}" name="password" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-select name="is_active" label="{{ __('Login Status') }}" :options="[0 => 'Cannot Login', 1 => 'User Can login']"
                                        :selected="old('is_active', $option ?? 0)" required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-select name="email_verified_at" label="{{ __('Verify Email') }}" :options="[
                                        0 => 'Email Verification Required',
                                        1 => 'Email Verification Not Required',
                                    ]"
                                        :selected="old('email_verified_at', $option ?? 0)" required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-button />
                    </div>
                    {{-- /.card-footer --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    </form>
@endsection

@push('styles')
    {{-- CSS here --}}
@endpush

@push('scripts')
    {{-- JS here --}}
@endpush
