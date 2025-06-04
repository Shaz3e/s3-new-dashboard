@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
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
                <h4 class="text-center f-w-500 mb-3">Sign up with your work email.</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <x-input type="text" name="first_name" placeholder="First Name" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <x-input type="text" name="last_name" placeholder="Last Name" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <x-input type="email" name="email" placeholder="Email Address" />
                </div>
                <div class="mb-3">
                    <x-input type="password" name="password" placeholder="Password" />
                </div>
                <div class="mb-3">
                    <x-input type="password" name="password_confirmation" placeholder="Confirm Password" />
                </div>
                <div class="d-flex mt-1 justify-content-between">
                    <x-checkbox name="agree_terms" label="I agree to all the Terms & Conditions" />
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Sign up</button>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <h6 class="f-w-500 mb-0">Already have an Account?</h6>
                    <a href="{{ route('login') }}" class="link-primary">Login here</a>
                </div>
            </form>
        </div>
        {{-- /.card-body --}}
    </div>
    {{-- /.card --}}
@endsection
