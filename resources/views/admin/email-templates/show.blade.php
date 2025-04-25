@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ 'Email Template Preview' }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.email-templates.index'), 'label' => __('Email Templates')],
        ['label' => __('View')],
    ]" />

    <div class="row">
        <div class="col-md-12 text-end">
            <x-action-link text="Back" :route="route('admin.email-templates.index')" iconPosition="left" icon="ti ti-arrow-left"
                permission="email-templates.read" />
            <x-action-link text="Edit" class="btn btn-outline btn-primary" iconPosition="left" icon="ti ti-edit"
                :route="route('admin.email-templates.edit', $emailTemplate->id)" permission="email-templates.update" />
        </div>
        {{-- /.col --}}
        <div class="col-md-12 mb-5">
            <h2>{{ $emailTemplate->subject }}</h2>
            <strong class="badge bg-success">{{ $emailTemplate->name }}</strong>
            @if ($emailTemplate->placeholders)
                @foreach ($emailTemplate->placeholders as $placeholder)
                    <small class="badge bg-primary">{{ $placeholder }}</small>
                @endforeach
            @endif
        </div>

        @if ($emailTemplate->header)
            <div class="col-md-12 mb-5">
                {!! $emailTemplate->header !!}
            </div>
            {{-- /.col --}}
        @endif

        <div class="col-md-12 mb-5">
            {!! $emailTemplate->body !!}
        </div>
        {{-- /.col --}}

        @if ($emailTemplate->footer)
            <div class="col-md-12 mb-5">
                {!! $emailTemplate->footer !!}
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
