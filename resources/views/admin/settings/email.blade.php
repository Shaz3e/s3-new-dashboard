@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Email Settings') }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Settings')]]" />

    <div class="row">
        <div class="col-md-3">
            @include('admin.settings.navbar')
        </div>
        {{-- /.col --}}
        <div class="col-md-9">
            <form action="{{ route('admin.settings.email') }}" method="POST" data-validate enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="text" name="mail_host" label="SMTP Host"
                                        value="{{ config('mail.mailers.smtp.host') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="text" name="mail_port" label="SMTP Port"
                                        value="{{ config('mail.mailers.smtp.port') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="text" name="mail_username" label="SMTP Username"
                                        value="{{ config('mail.mailers.smtp.username') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="password" name="mail_password" label="SMTP Password"
                                        value="{{ config('mail.mailers.smtp.password') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-select name="mail_encryption" label="{{ __('SMTP Encryption') }}" :options="[
                                        'ssl' => 'SSL',
                                        'tls' => 'TLS',
                                        'null' => 'None',
                                    ]"
                                        :selected="config('mail.mailers.smtp.encryption')" required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="text" name="mail_from_address" label="Mail From Address"
                                        value="{{ config('mail.from.address') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="text" name="mail_from_name" label="Mail From Name"
                                        value="{{ config('mail.from.name') }}" required />
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
            </form>
        </div>
        {{-- /.col --}}
    </div>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
