@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="text-center py-3">
                    <a href="#"><img src="../assets/images/logo-dark.svg" alt="img" /></a>
                </div>
                <h4 class="text-center f-w-500 mb-3">Sign up with your work email.</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" />
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" />
                            @error('last_name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" />
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" />
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm Password" />
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </div>
                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="" />
                        <label class="form-check-label text-muted" for="customCheckc1">I agree to all the Terms &
                            Condition</label>
                    </div>
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
