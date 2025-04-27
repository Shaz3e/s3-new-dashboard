@extends('components.layouts.app')

@section('content')
    <x-page-title title="Global Header & Footer List" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Global Header & Footer')]]" />

    <div class="row mb-3">
        <div class="col-md-12 text-end">
            <x-action-link text="Edit" class="btn btn-outline btn-primary" iconPosition="left" icon="ti ti-edit"
                :route="route('admin.global-email-templates.edit')" permission="global-email-templates.update" />
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    <div class="row">
        @if ($globalEmailTemplate->header_image)
            <div class="col-md-12 mb-2 text-center">
                <img src="{{ asset($globalEmailTemplate->header_image) }}" class="img-fluid" alt="img" />
            </div>
            {{-- /.col --}}
        @endif

        @if ($globalEmailTemplate->header_text)
            <div class="col-md-12">
                <div
                    style="color: {{ $globalEmailTemplate->header_text_color }}; background-color: {{ $globalEmailTemplate->header_background_color }}">
                    {!! $globalEmailTemplate->header_text !!}
                </div>
            </div>
            {{-- /.col --}}
        @endif

        <div class="col-md-12 mb-2">
            {!! $globalEmailTemplate->body !!}
        </div>
        {{-- /.col --}}

        @if ($globalEmailTemplate->footer_image)
            <div class="col-md-12 text-center mb-3">
                <img src="{{ asset($globalEmailTemplate->footer_image) }}" class="img-fluid" alt="img" />
            </div>
            {{-- /.col --}}
        @endif

        @if ($globalEmailTemplate->footer_text)
            <div class="col-md-12 mb-3">
                <div
                    style="color: {{ $globalEmailTemplate->footer_text_color }}; background-color: {{ $globalEmailTemplate->footer_background_color }}">
                    {!! $globalEmailTemplate->footer_text !!}
                </div>
            </div>
            {{-- /.col --}}
        @endif

        @if ($globalEmailTemplate->footer_bottom_image)
            <div class="col-md-12 text-center mb-3">
                <img src="{{ asset($globalEmailTemplate->footer_bottom_image) }}" class="img-fluid" alt="img" />
            </div>
            {{-- /.col --}}
        @endif
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
