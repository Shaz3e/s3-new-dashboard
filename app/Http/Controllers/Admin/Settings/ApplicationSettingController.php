<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationSettingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function view()
    {
        return view('admin.settings.application', [
            'title' => 'Settings',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|max:255',
            'app_url' => 'required|url',
            'dark_logo' => 'image|mimes:png,jpg|max:2048',
            'light_logo' => 'image|mimes:png,jpg|max:2048',
            'favicon' => 'image|mimes:png,jpg|max:2048',
        ]);

        $fileKeys = ['dark_logo', 'light_logo', 'favicon'];

        foreach ($fileKeys as $key) {
            if ($request->hasFile($key)) {
                $oldFile = Setting::where('key', $key)->first();
                if ($oldFile) {
                    Storage::disk('public')->delete($oldFile->value);
                }
                $validated[$key] = $request->file($key)->store('logos', 'public');
            }
        }

        // Loop through all validated settings and update or create
        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        session()->flash('success', 'Settings updated successfully.');

        return back();
    }
}
