<div>
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
                                                class="btn btn-primary btn-sm">Download</a>
                                            <form action="{{ route('admin.app-backup.delete', $file->getFilename()) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm delete-button">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $files->links() }}
                        </div>
                    @endif
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
</div>
