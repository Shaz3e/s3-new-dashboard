@extends('components.layouts.app')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Other</a></li>
                        <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Sample Page</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
