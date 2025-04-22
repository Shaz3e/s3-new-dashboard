<?php

namespace App\Livewire\Admin\AppBackups;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class AppBackupsList extends Component
{
    use WithPagination;

    public function render()
    {
        $appName = config('app.name');
        $path = storage_path("app/private/{$appName}");

        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $files = collect(File::files($path))
            ->filter(fn ($file) => $file->getExtension() === 'zip')
            ->sortByDesc(fn ($file) => $file->getCTime())
            ->values();

        // Manually paginate the collection (since it's not a database query)
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $files->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedFiles = new LengthAwarePaginator(
            $currentItems,
            $files->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('livewire.admin.app-backups.app-backups-list', [
            'files' => $paginatedFiles,
        ]);
    }
}
