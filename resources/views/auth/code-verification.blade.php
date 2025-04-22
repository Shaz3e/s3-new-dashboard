@extends('components.layouts.auth')

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="mb-4">
                            <h3 class="mb-2"><b>Enter Verification Code</b></h3>
                            <p class="text-muted mb-4">We send you on mail.</p>
                            <p class="">We`ve send you code on <strong>{{ $maskedEmail }}</strong>. Please check your
                                email inbox or
                                spam folder</p>
                            @error('code')
                                <div class="alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                        </div>
                        <form action="{{ route('verification') }}" method="POST" class="row my-4 text-center">
                            @csrf
                            <div class="col">
                                <input type="number" name="code[]" class="form-control text-center code-input"
                                    placeholder="0" maxlength="1" oninput="moveToNext(this, 'code2')"
                                    onpaste="return false;" required />
                            </div>
                            <div class="col">
                                <input type="number" name="code[]" id="code2"
                                    class="form-control text-center code-input" placeholder="0" maxlength="1"
                                    oninput="moveToNext(this, 'code3')" onpaste="return false;" required />
                            </div>
                            <div class="col">
                                <input type="number" name="code[]" id="code3"
                                    class="form-control text-center code-input" placeholder="0" maxlength="1"
                                    oninput="moveToNext(this, 'code4')" onpaste="return false;" required />
                            </div>
                            <div class="col">
                                <input type="number" name="code[]" id="code4"
                                    class="form-control text-center code-input" placeholder="0" maxlength="1"
                                    oninput="moveToNext(this)" onpaste="return false;" required />
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </form>
                        <div class="d-flex align-items-center mt-3">
                            <p class="mb-0 me-2">Did not receive the email?</p>
                            <form action="{{ route('resend.verification') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link p-0">Resend</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function moveToNext(current, nextFieldId) {
            // Check if the input has a single digit
            if (current.value.length === 1) {
                if (nextFieldId) {
                    document.getElementById(nextFieldId).focus();
                }
            }
        }

        // Add an event listener to prevent more than one digit in each input
        document.querySelectorAll('.code-input').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.length > 1) {
                    this.value = this.value.slice(0, 1); // Keep only the first digit
                }
            });

            // Disable pasting
            input.addEventListener('paste', (e) => {
                e.preventDefault();
            });
        });
    </script>
@endpush
