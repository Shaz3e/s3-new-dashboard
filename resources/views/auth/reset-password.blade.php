@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('password.reset') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ request('token') }}" />
                <input type="hidden" name="email" value="{{ request('email') }}" />

                <a href="{{ config('app.url') }}"><img src="{{ asset('assets/images/logo-dark.svg') }}" class="mb-4 img-fluid" alt="img" /></a>
                <div class="mb-4">
                    <h3 class="mb-2"><b>Reset Password</b></h3>
                    <p class="text-muted">Please choose your new password</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="floatingInput" placeholder="Password" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="floatingInput1"
                        placeholder="Confirm Password" />
                </div>
                <div class="d-grid mt-4">
                    <x-button text="Reset Password" />
                </div>
            </form>
        </div>
        {{-- /.card-body --}}
    </div>
    {{-- /.card --}}
@endsection
