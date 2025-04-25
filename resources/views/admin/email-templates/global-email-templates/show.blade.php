@extends('components.layouts.app')

@section('content')
    <x-page-title title="Header & Footer Preview" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.global-email-templates.index'), 'label' => __('Global Header & Footer')],
        ['label' => __('View')],
    ]" />

    <div class="row">
        @if ($globalEmailTemplate->header)
            <div class="col-md-12">
                {!! $globalEmailTemplate->header !!}
            </div>
            {{-- /.col --}}
        @endif
        @if ($globalEmailTemplate->footer)
            <div class="col-md-12">
                {!! $globalEmailTemplate->footer !!}
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
