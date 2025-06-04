@extends('components.layouts.auth')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <form action="{{ route('locked') }}" method="POST" data-validate>
                @csrf
                <div class="py-3">
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
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Unlock Your Account</b></h3>
                </div>


                <div class="mb-3">
                    <input type="password" name="password" class="form-control" id="floatingInput1"
                        placeholder="Password" />
                </div>


                <div class="d-grid mt-4">
                    <x-button text="Unlock My Account" class="btn-primary" />
                </div>

            </form>
        </div>
        {{-- /.card-body --}}
    </div>
    {{-- /.card --}}
@endsection
