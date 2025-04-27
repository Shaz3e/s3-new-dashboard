<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGlobalEmailTemplateRequest;
use App\Models\GlobalEmailTemplate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class GlobalEmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', GlobalEmailTemplate::class);

        $globalEmailTemplate = GlobalEmailTemplate::first();

        return view('admin.email-templates.global-email-templates.index', [
            'title' => 'Global Email Templates',
            'globalEmailTemplate' => $globalEmailTemplate,
        ]);
    }

    public function edit()
    {
        Gate::authorize('create', GlobalEmailTemplate::class);

        $globalEmailTemplate = GlobalEmailTemplate::first();

        return view('admin.email-templates.global-email-templates.edit', [
            'globalEmailTemplate' => $globalEmailTemplate,
        ]);
    }

    public function update(StoreGlobalEmailTemplateRequest $request)
    {
        Gate::authorize('update', GlobalEmailTemplate::class);

        $validated = $request->validated();

        $globalEmailTemplate = GlobalEmailTemplate::first();

        // First delete images and then Upload images
        if ($request->hasFile('header_image')) {
            // Delete old image
            if ($globalEmailTemplate->header_image) {
                Storage::disk('public')->delete($globalEmailTemplate->header_image);
            }
            $validated['header_image'] = $request->file('header_image')
                ->store('global-email-templates', 'public');
        }
        if ($request->hasFile('footer_image')) {
            // Delete old image
            if ($globalEmailTemplate->footer_image) {
                Storage::disk('public')->delete($globalEmailTemplate->footer_image);
            }
            $validated['footer_image'] = $request->file('footer_image')
                ->store('global-email-templates', 'public');
        }
        if ($request->hasFile('footer_bottom_image')) {
            // Delete old image
            if ($globalEmailTemplate->footer_bottom_image) {
                Storage::disk('public')->delete($globalEmailTemplate->footer_bottom_image);
            }
            $validated['footer_bottom_image'] = $request->file('footer_bottom_image')
                ->store('global-email-templates', 'public');
        }

        $globalEmailTemplate->update($validated);

        flash()->success('Global Header & Footer are updated');

        return back();
    }
}
