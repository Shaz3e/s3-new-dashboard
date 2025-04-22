@extends('components.layouts.auth')

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card">
                    <div class="card-body position-relative">
                        <div class="position-absolute end-0 top-0 p-3">
                            <x-user-avatar class="rounded-circle img-fluid wid-70" />
                        </div>
                        <div class="mb-4">
                            <h3 class="mb-2">

                                <b>Hi, {{ auth()->user()->name }}</b>
                            </h3>
                            <p class="text-muted">You cannot access dashboard as your account is suspended.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
