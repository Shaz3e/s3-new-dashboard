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

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h5 class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            Backup Files
                        </div>
                        <div class="col-md-4 text-end">
                            <form action="{{ route('admin.app-backup.store') }}" method="POST"
                                enctype="multipart/form-data" data-validate>
                                @csrf
                                <input type="hidden" name="appBackupUpdate" value="1">
                                <x-button class="btn btn-success" text="Backup App" />
                            </form>
                        </div>
                    </div>
                </h5>
                <div class="card-body">
                    @if ($files->isEmpty())
                        <p>No backup files found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Size</th>
                                    <th>Last Modified</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $file->getFilename() }}</td>
                                        <td>{{ number_format($file->getSize() / 1024, 2) }} KB</td>
                                        <td>{{ date('Y-m-d H:i:s', $file->getCTime()) }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.app-backup.download', $file->getFilename()) }}"
                                                class="btn btn-primary btn-sm">
                                                Download
                                            </a>

                                            <form action="{{ route('admin.app-backup.delete', $file->getFilename()) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm delete-button">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
    {{-- CSS here --}}
@endpush

@push('scripts')
@endpush
