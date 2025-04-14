@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Dashboard') }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('Dashboard')]]" />

    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Hello card</h5>
                </div>
                <div class="card-body">
                    {{ auth()->user()->name }}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
