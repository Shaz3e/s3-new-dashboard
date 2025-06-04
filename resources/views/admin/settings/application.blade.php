@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Application Settings') }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Settings')]]" />

    <div class="row">
        <div class="col-md-3">
            @include('admin.settings.navbar')
        </div>
        {{-- /.col --}}
        <div class="col-md-9">
            <form action="{{ route('admin.settings.application') }}" method="POST" data-validate
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="text" name="app_name" label="Application Name"
                                        value="{{ setting('app_name') ?? config('app.name') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="text" name="site_url" label="Website URL"
                                        value="{{ setting('app_url') ?? config('app.url') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="text" name="app_url" label="Application URL"
                                        value="{{ setting('app_url') ?? config('app.url') }}" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="file" name="dark_logo" label="Dark Logo"
                                        help_text="{{ __('The dark logo will be used in dark mode. Only JPG, PNG with max 2MB file size allowed. Best image size 120x40 in pixel') }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="file" name="light_logo" label="Light Logo"
                                        help_text="{{ __('The light logo will be used in light mode. Only JPG, PNG with max 2MB file size allowed. Best image size 120x40 in pixel') }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input type="file" name="favicon" label="Fav Icon"
                                        help_text="{{ __('Only JPG, PNG with max 2MB file size allowed. Best image size 512x512 in pixel') }}" />
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
