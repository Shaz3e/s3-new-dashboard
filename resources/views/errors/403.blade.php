@extends('components.layouts.app')

@section('content')
    <div class="maintenance-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card error-card">
                        <div class="card-body">
                            <div class="error-image-block">
                                <div class="row justify-content-center">
                                    <div class="col-10">
                                        <img class="img-fluid" src="{{ asset('assets/images/pages/img-error-500.svg') }}"
                                            alt="img" />
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="mt-4"><b>Unauthorized Access</b></h1>
                                <p class="mt-2 mb-4 text-sm text-muted">
                                    You do not have permission to access this page
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
