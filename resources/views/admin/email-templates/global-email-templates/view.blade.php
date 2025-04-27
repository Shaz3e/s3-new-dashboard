@extends('components.layouts.app')

@section('content')
    <x-page-title title="Header & Footer Preview" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.global-email-templates.index'), 'label' => __('Global Header & Footer')],
        ['label' => __('View')],
    ]" />

    <div class="row">
        view
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
