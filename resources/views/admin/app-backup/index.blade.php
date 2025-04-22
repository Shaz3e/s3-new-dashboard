@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ __('App Backup') }}" :breadcrumbs="[['url' => '/', 'label' => __('Dashboard')], ['label' => __('App Backup')]]" />


    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('admin.app-backup.store') }}" method="POST" enctype="multipart/form-data" data-validate>
                @csrf
                <input type="hidden" name="appBackup" value="1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <x-input type="email" name="app_backup_notification_email" label="Notification Email"
                                    value="{{ config('backup.notifications.mail.to') ?? '' }}" :required="true" />
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-button text="Save" />
                    </div>
                </div>
                {{-- /.card --}}
            </form>
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    @livewire('admin.app-backups.app-backups-list')
@endsection

@push('styles')
    {{-- CSS here --}}
@endpush

@push('scripts')
@endpush
