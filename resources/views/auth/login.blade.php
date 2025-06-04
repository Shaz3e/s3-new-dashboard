@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="text-center py-3">
                    <a href="{{ setting('site_url') ?? config('app_url') }}" class="b-brand text-primary">
                        @if (setting('dark_logo') || setting('light_logo'))
                            <img src="{{ asset(setting('dark_logo')) }}" class="img-fluid logo-lg" alt="logo"
                                data-dark-logo="{{ asset(setting('dark_logo')) }}"
                                data-light-logo="{{ asset(setting('light_logo')) }}" />
                        @else
                            {{ setting('app_name') ?? config('app.name') }}
                        @endif
                    </a>
                </div>
                <h4 class="text-center f-w-500 mb-3">Login with your email</h4>
                @if (session('error'))
                    <div class="mb-3">
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <div class="mb-3">
                    <x-input type="email" name="email" placeholder="Email Address" required />
                </div>
                <div class="mb-3">
                    <x-input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="d-flex mt-1 justify-content-between align-items-center">
                    <x-checkbox name="remember" label="Remember Me" />
                    <h6 class="text-secondary f-w-400 mb-0">
                        <a href="{{ route('forgot') }}"> Forgot Password? </a>
                    </h6>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <h6 class="f-w-500 mb-0">Don't have an Account?</h6>
                    <a href="{{ route('register') }}" class="link-primary">Create Account</a>
                </div>
            </form>
        </div>
        {{-- /.card-body --}}

        @env('local')
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-6">
                    <x-login-link key="2" label="Login as Developer" class="btn btn-success mb-2" />
                    <x-login-link key="1" label="Login as Super Admin" class="btn btn-success mb-2" />
                    <x-login-link key="3" label="Login as Tester" class="btn btn-success mb-2" />
                    <x-login-link key="4" label="Login as Admin" class="btn btn-success mb-2" />
                    <x-login-link key="5" label="Login as Manager" class="btn btn-success mb-2" />
                    <x-login-link key="6" label="Login as Staff" class="btn btn-success mb-2" />
                </div>
                {{-- /.col --}}
                <div class="col-lg-6">
                    <x-login-link key="7" label="Login as User One" class="btn btn-success mb-2" />
                    <x-login-link key="8" label="Login as User Two" class="btn btn-success mb-2" />
                    <x-login-link key="9" label="Login as User Three" class="btn btn-success mb-2" />
                    <x-login-link key="10" label="Login as User Four" class="btn btn-success mb-2" />
                </div>
                {{-- /.col --}}
            </div>
            {{-- /.row --}}
        </div>
        {{-- /.card-footer --}}
        @endenv
    </div>
    {{-- /.card --}}
@endsection
