@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ 'Create New Email Template' }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.email-templates.index'), 'label' => __('Email Templates')],
        ['label' => __('Create')],
    ]" />

    <form action="{{ route('admin.email-templates.store') }}" method="POST" data-validate>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <x-input type="text" name="header" label="Header" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <x-input type="text" name="footer" label="Footer" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <x-input type="text" name="subject" label="Subject" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <x-textarea name="body" label="Email Body" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <x-input type="text" name="name" label="Unique Email Name"
                                        help_text="Email name should be unique this is the key for sending email with" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <x-textarea name="placeholders" label="Placeholders"
                                        help_text="Use comma separated placeholders" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}

            <div class="col-md-12 mb-5">
                <x-button text="Save" />
            </div>
        </div>
        {{-- /.row --}}
    </form>
@endsection

@push('styles')
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const subjectInput = document.getElementById('name');

            if (subjectInput) {
                subjectInput.addEventListener('input', () => {
                    // Replace spaces with underscores and remove consecutive underscores
                    subjectInput.value = subjectInput.value
                        .replace(/ +/g, '_') // Replace one or more spaces with a single underscore
                        .replace(/_+/g, '_'); // Remove consecutive underscores
                });
            }
        });
        document.getElementById('placeholders').addEventListener('input', function(event) {
            let input = event.target.value;

            // Replace multiple spaces and commas with a single comma
            input = input.replace(/\s+/g, ',').replace(/,+/g, ',').trim();

            // Update the textarea value with formatted placeholders
            event.target.value = input;
        });

        // Optional: Convert to JSON array when form is submitted
        document.querySelector('form').addEventListener('submit', function() {
            const placeholdersField = document.getElementById('placeholders');

            // Convert the input string to an array before submission
            if (placeholdersField.value.trim() !== '') {
                placeholdersField.value = JSON.stringify(placeholdersField.value.split(','));
            }
        });
    </script>
@endpush
