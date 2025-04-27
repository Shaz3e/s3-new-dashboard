@extends('components.layouts.app')

@section('content')
    <x-page-title title="Header & Footer Preview" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.global-email-templates.index'), 'label' => __('Global Header & Footer')],
        ['label' => __('View')],
    ]" />

    <form action="{{ route('admin.global-email-templates.update') }}" method="POST" data-validate enctype="multipart/form-data">
        @csrf
        @method('POST')
        {{-- Header --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Header</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 col-sm-12 mb-3">
                                <div class="form-group">
                                    <x-input type="file" name="header_image" label="Header Image" />
                                    @if ($globalEmailTemplate->header_image)
                                        <img src="{{ asset($globalEmailTemplate->header_image) }}" class="img-fluid"
                                            alt="img" />
                                    @endif
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <x-input type="color" name="header_text_color" class="form-control-color"
                                        label="Text Color" value="{{ $globalEmailTemplate->header_text_color }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <x-input type="color" name="header_background_color" class="form-control-color"
                                        label="Background Color" value="{{ $globalEmailTemplate->header_background_color }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <x-textarea name="header_text" label="Header Text"
                                        value="{{ $globalEmailTemplate->header_text }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}

        {{-- Footer --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Footer</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-3">
                                <div class="form-group">
                                    <x-input type="file" name="footer_image" label="Footer Top Image" />
                                    @if ($globalEmailTemplate->footer_image)
                                        <img src="{{ asset($globalEmailTemplate->footer_image) }}" class="img-fluid"
                                            alt="img" />
                                    @endif
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4 col-sm-12 mb-3">
                                <div class="form-group">
                                    <x-input type="file" name="footer_bottom_image" label="Footer Bottom Image" />
                                    @if ($globalEmailTemplate->footer_bottom_image)
                                        <img src="{{ asset($globalEmailTemplate->footer_bottom_image) }}" class="img-fluid"
                                            alt="img" />
                                    @endif
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <x-input type="color" name="footer_text_color" class="form-control-color"
                                        label="Text Color" value="{{ $globalEmailTemplate->footer_text_color }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <x-input type="color" name="footer_background_color" class="form-control-color"
                                        label="Background Color" value="{{ $globalEmailTemplate->footer_background_color }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <x-textarea name="footer_text" label="Footer Text"
                                        value="{{ $globalEmailTemplate->footer_text }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}

        {{-- Save Button --}}
        <div class="row">
            <div class="col-md-12 mb-5">
                <x-button text="Save" />
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    </form>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
