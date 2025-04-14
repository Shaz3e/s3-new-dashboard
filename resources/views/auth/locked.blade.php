@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('locked') }}" method="POST" data-validate>
                @csrf
                <div class="py-3">
                    <a href="#"><img src="../assets/images/logo-dark.svg" alt="img" /></a>
                </div>
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Unlock Your Account</b></h3>
                </div>


                <div class="mb-3">
                    <input type="password" name="password" class="form-control" id="floatingInput1"
                        placeholder="Password" />
                </div>


                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Unlock My Account</button>
                </div>

            </form>
        </div>
        {{-- /.card-body --}}
    </div>
    {{-- /.card --}}
@endsection
