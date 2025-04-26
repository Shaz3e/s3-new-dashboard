@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('forgot') }}" method="POST">
                @csrf
                <a href="#"><img src="../assets/images/logo-dark.svg" class="mb-4 img-fluid" alt="img" /></a>
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Forgot Password</b></h3>
                    <a href="{{ route('login') }}" class="link-primary">Back to Login</a>
                </div>
                <div class="mb-3">
                    <x-input type="email" name="email" placeholder="Email Address" />
                </div>
                <p class="mt-4 text-sm text-muted">Do not forgot to check SPAM box.</p>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">Send Password Reset Email</button>
                </div>
            </form>
        </div>
        {{-- /.card-body --}}
    </div>
    {{-- /.card --}}
@endsection
