@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ 'Email Template Preview' }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.email-templates.index'), 'label' => __('Email Templates')],
        ['label' => __('View')],
    ]" />

    <div class="row mb-3">
        <div class="col-md-12 text-end">
            <x-action-link text="Back" :route="route('admin.email-templates.index')" iconPosition="left" icon="ti ti-arrow-left"
                permission="email-templates.read" />
            <x-action-link text="Edit" class="btn btn-outline btn-primary" iconPosition="left" icon="ti ti-edit"
                :route="route('admin.email-templates.edit', $emailTemplate->id)" permission="email-templates.update" />
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    <div class="row">
        <div class="col-md-12 mb-5">
            <h2>{{ $emailTemplate->subject }}</h2>
            <strong class="badge bg-success">{{ $emailTemplate->name }}</strong>
            <strong class="badge bg-secondary">{{ $emailTemplate->key }}</strong>
            @if ($emailTemplate->placeholders)
                @foreach ($emailTemplate->placeholders as $placeholder)
                    <small class="badge bg-primary">{{ $placeholder }}</small>
                @endforeach
            @endif
        </div>

        @if ($emailTemplate->header_image)
            <div class="col-md-12 mb-2 text-center">
                <img src="{{ asset($emailTemplate->header_image) }}" class="img-fluid" alt="img" />
            </div>
            {{-- /.col --}}
        @endif

        @if ($emailTemplate->header_text)
            <div class="col-md-12">
                <div
                    style="color: {{ $emailTemplate->header_text_color }}; background-color: {{ $emailTemplate->header_background_color }}">
                    {!! $emailTemplate->header_text !!}
                </div>
            </div>
            {{-- /.col --}}
        @endif

        <div class="col-md-12 mb-2">
            {!! $emailTemplate->body !!}
        </div>
        {{-- /.col --}}

        @if ($emailTemplate->footer_image)
            <div class="col-md-12 text-center mb-3">
                <img src="{{ asset($emailTemplate->footer_image) }}" class="img-fluid" alt="img" />
            </div>
            {{-- /.col --}}
        @endif

        @if ($emailTemplate->footer_text)
            <div class="col-md-12 mb-3">
                <div
                    style="color: {{ $emailTemplate->footer_text_color }}; background-color: {{ $emailTemplate->footer_background_color }}">
                    {!! $emailTemplate->footer_text !!}
                </div>
            </div>
            {{-- /.col --}}
        @endif

        @if ($emailTemplate->footer_bottom_image)
            <div class="col-md-12 text-center mb-3">
                <img src="{{ asset($emailTemplate->footer_bottom_image) }}" class="img-fluid" alt="img" />
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
