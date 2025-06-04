@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('forgot') }}" method="POST">
                @csrf

                <a href="{{ setting('site_url') ?? config('app_url') }}" class="b-brand text-primary">
                    @if (setting('dark_logo') || setting('light_logo'))
                        <img src="{{ asset(setting('dark_logo')) }}" class="img-fluid logo-lg" alt="logo"
                            data-dark-logo="{{ asset(setting('dark_logo')) }}"
                            data-light-logo="{{ asset(setting('light_logo')) }}" />
                    @else
                        {{ setting('app_name') ?? config('app.name') }}
                    @endif
                </a>
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Forgot Password</b></h3>
                    <a href="{{ route('login') }}" class="link-primary">Back to Login</a>
                </div>
                <div class="mb-3">
                    <x-input type="email" name="email" placeholder="Email Address" />
                </div>
                <p class="mt-4 text-sm text-muted">Do not forgot to check SPAM box.</p>
                <div class="d-grid mt-3">
                    <x-button text="Reset Password" class="btn-primary" />
                </div>
            </form>
        </div>
        {{-- /.card-body --}}
    </div>
    {{-- /.card --}}
@endsection
