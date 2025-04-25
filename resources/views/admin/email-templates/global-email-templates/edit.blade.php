@extends('components.layouts.app')

@section('content')
    <x-page-title title="Edit Header & Footer" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.global-email-templates.index'), 'label' => __('Global Header & Footer')],
        ['label' => __('Edit')],
    ]" />

    <form action="{{ route('admin.global-email-templates.update', $globalEmailTemplate->id) }}" method="POST" data-validate>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <x-input type="text" name="header" label="Header" value="{{ $globalEmailTemplate->header }}" />
                    <x-checkbox name="default_header" label="Make this header default" :checked="$globalEmailTemplate->default_header" />
                </div>
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <x-input type="text" name="footer" label="Footer" value="{{ $globalEmailTemplate->footer }}" />
                    <x-checkbox name="default_footer" label="Make this footer default" :checked="$globalEmailTemplate->default_footer" />
                </div>
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
        <div class="row">
            <div class="col-md-12 mb-5">
                <x-button text="Save" />
            </div>
        </div>
        {{-- /.row --}}
    </form>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
