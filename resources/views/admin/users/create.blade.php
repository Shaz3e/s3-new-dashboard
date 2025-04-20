@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('Create New Staff') }}" :breadcrumbs="[
        ['url' => route('admin.dashboard'), 'label' => __('Dashboard')],
        ['url' => route('admin.users.index'), 'label' => __('Manage Staff')],
        ['label' => __('Create')],
    ]" />



    <form action="{{ route('admin.users.store') }}" method="POST" data-validate>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-input type="text" label="{{ __('First Name') }}" name="first_name" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-input type="text" label="{{ __('Last Name') }}" name="last_name" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-input type="email" label="{{ __('Email') }}" name="email" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-input type="password" label="{{ __('Password') }}" name="password" required />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-select name="is_active" label="{{ __('Login Status') }}" :options="[0 => 'Cannot Login', 1 => 'User Can login']"
                                        :selected="old('is_active', $option ?? 0)" required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-select name="email_verified_at" label="{{ __('Verify Email') }}" :options="[
                                        0 => 'Email Verification Required',
                                        1 => 'Email Verification Not Required',
                                    ]"
                                        :selected="old('email_verified_at', $option ?? 0)" required="true" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roles" class="form-label">Roles</label>
                                    <select class="form-control" data-trigger name="roles[]" id="roles" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-button />
                    </div>
                    {{-- /.card-footer --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    </form>
@endsection

@push('styles')
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Choices.js with the remove button
            var genericExamples = document.querySelectorAll('[data-trigger]');
            for (let i = 0; i < genericExamples.length; ++i) {
                var element = genericExamples[i];
                new Choices(element, {
                    removeItemButton: true, // Add remove button
                    placeholderValue: 'Select your roles',
                    searchPlaceholderValue: 'Search roles'
                });
            }
        });
    </script>
@endpush
