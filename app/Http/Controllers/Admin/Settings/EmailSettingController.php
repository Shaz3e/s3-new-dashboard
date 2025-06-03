<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class EmailSettingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function view()
    {
        return view('admin.settings.email', [
            'title' => 'Settings',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mail_host' => 'required',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',
        ]);

        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        $envData = [
            'MAIL_HOST' => $validated['mail_host'],
            'MAIL_PORT' => $validated['mail_port'],
            'MAIL_USERNAME' => $validated['mail_username'],
            'MAIL_PASSWORD' => "\"{$validated['mail_password']}\"",
            'MAIL_ENCRYPTION' => $validated['mail_encryption'],
            'MAIL_FROM_ADDRESS' => $validated['mail_from_address'],
            'APP_NAME' => "\"{$validated['mail_from_name']}\"",
        ];

        // Update the key-value pairs
        foreach ($envData as $key => $value) {
            $envContent = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $envContent);
        }

        File::put($envPath, $envContent);

        Artisan::call('config:clear');
        Artisan::call('config:cache');

        flash()->success(__('Email Settings Saved.'));

        return back();
    }
}
