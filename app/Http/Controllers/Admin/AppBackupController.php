<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\AppBackupJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AppBackupController extends Controller
{
    public function index()
    {
        $user = Auth::user()->hasAnyRole(['developer', 'superadmin', 'tester']);

        if (! $user) {
            abort(403);
        }

        return view('admin.app-backup.index', [
            'title' => 'App Backup',
        ]);
    }

    public function store(Request $request)
    {
        if ($request->has('appBackup')) {
            return $this->appBackup($request);
        }

        if ($request->has('appBackupUpdate')) {
            return $this->appBackupUpdate($request);
        }
    }

    public function download($fileName)
    {
        $appName = config('app.name');
        $path = storage_path("app/private/{$appName}/{$fileName}");

        if (! File::exists($path)) {
            return back()->withErrors(['message' => 'File not found!']);
        }

        return Response::download($path, $fileName);
    }

    public function delete($fileName)
    {
        // Get the app name from config
        $appName = config('app.name');

        // Define the file path
        $filePath = storage_path("app/private/{$appName}/{$fileName}");

        // Check if the file exists
        if (! file_exists($filePath)) {
            flash()->error('File not found!');
        }

        // Attempt to delete the file
        if (unlink($filePath)) {
            flash()->success('File deleted successfully!');
        }

        return back();
    }

    private function appBackup(Request $request)
    {
        $validated = $request->validate([
            'app_backup_notification_email' => 'required|email',
        ]);

        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        $envData = [
            'APP_BACKUP_NOTIFICATION_EMAIL' => $validated['app_backup_notification_email'],
        ];

        // Update the key-value pairs in the .env content
        foreach ($envData as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                // If the key does not exist, add it
                $envContent .= "\n{$key}={$value}";
            }
        }

        File::put($envPath, $envContent);

        Artisan::call('config:clear');

        flash()->success(__('App Backup Settings Saved.'));

        return back();
    }

    private function appBackupUpdate(Request $request)
    {
        // Dispatch the job
        AppBackupJob::dispatch();

        // Flash a message for the user
        flash()->success('Backup process started. You will be notified upon completion.');

        return back();
    }
}
