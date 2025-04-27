<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmailTemplateRequest;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Shaz3e\EmailBuilder\Facades\EmailBuilder;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', EmailTemplate::class);

        return view('admin.email-templates.index', [
            'title' => 'Email Templates',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', EmailTemplate::class);

        return view('admin.email-templates.create', [
            'title' => 'Create New Email Template',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmailTemplateRequest $request)
    {
        Gate::authorize('create', EmailTemplate::class);

        $validated = $request->validated();

        // Upload images
        if ($request->hasFile('header_image')) {
            $validated['header_image'] = $request->file('header_image')
                ->store('email-templates', 'public');
        }
        if ($request->hasFile('footer_image')) {
            $validated['footer_image'] = $request->file('footer_image')
                ->store('email-templates', 'public');
        }
        if ($request->hasFile('footer_bottom_image')) {
            $validated['footer_bottom_image'] = $request->file('footer_bottom_image')
                ->store('email-templates', 'public');
        }

        $emailTemplate = EmailBuilder::addTemplate($validated);

        flash()->success('Email Template has been created');

        return redirect()->route('admin.email-templates.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailTemplate $emailTemplate)
    {
        Gate::authorize('view', $emailTemplate);

        $emailTemplate = EmailBuilder::getTemplate($emailTemplate->id);

        return view('admin.email-templates.show', [
            'title' => 'View Email Template',
            'emailTemplate' => $emailTemplate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        Gate::authorize('update', $emailTemplate);

        $placeholders = EmailBuilder::convertPlaceholdersToString($emailTemplate->placeholders);

        return view('admin.email-templates.edit', [
            'title' => 'Edit Email Template',
            'emailTemplate' => $emailTemplate,
            'placeholders' => $placeholders,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmailTemplateRequest $request, EmailTemplate $emailTemplate)
    {
        Gate::authorize('update', $emailTemplate);

        $validated = $request->validated();

        // First delete images and then Upload images
        if ($request->hasFile('header_image')) {
            // Delete old image
            if ($emailTemplate->header_image) {
                Storage::disk('public')->delete($emailTemplate->header_image);
            }
            $validated['header_image'] = $request->file('header_image')
                ->store('email-templates', 'public');
        }
        if ($request->hasFile('footer_image')) {
            // Delete old image
            if ($emailTemplate->footer_image) {
                Storage::disk('public')->delete($emailTemplate->footer_image);
            }
            $validated['footer_image'] = $request->file('footer_image')
                ->store('email-templates', 'public');
        }
        if ($request->hasFile('footer_bottom_image')) {
            // Delete old image
            if ($emailTemplate->footer_bottom_image) {
                Storage::disk('public')->delete($emailTemplate->footer_bottom_image);
            }
            $validated['footer_bottom_image'] = $request->file('footer_bottom_image')
                ->store('email-templates', 'public');
        }

        $emailTemplate = EmailBuilder::editTemplate($emailTemplate->id, $validated);

        flash()->success('Email Template has been updated');

        return redirect()->route('admin.email-templates.index');
    }
}
