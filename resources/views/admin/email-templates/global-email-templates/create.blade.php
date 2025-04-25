@extends('components.layouts.app')

@section('content')
    <x-page-title title="Create New Header & Footer" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.global-email-templates.index'), 'label' => __('Global Header & Footer')],
        ['label' => __('Create')],
    ]" />

    <form action="{{ route('admin.global-email-templates.store') }}" method="POST" data-validate>
        @csrf

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <x-input type="text" name="header" label="Header" />
                    <x-checkbox name="default_header" label="Make this header default" />

                </div>
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <x-input type="text" name="footer" label="Footer" />
                    <x-checkbox name="default_footer" label="Make this footer default" />
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
