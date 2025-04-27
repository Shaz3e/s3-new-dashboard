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

        $validated = $this->processRequest($request);

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

        $validated = $this->processRequest($request, $emailTemplate);

        $emailTemplate = EmailBuilder::editTemplate($emailTemplate->id, $validated);

        flash()->success('Email Template has been updated');

        return redirect()->route('admin.email-templates.index');
    }

    private function processRequest(StoreEmailTemplateRequest $request, ?EmailTemplate $emailTemplate = null): array
    {
        $validated = $request->validated();

        // Handle images
        $validated = $this->handleImages($request, $validated, $emailTemplate);

        // Remove fields if header/footer not selected
        $validated = $this->filterFields($validated);

        return $validated;
    }

    private function handleImages(StoreEmailTemplateRequest $request, array $validated, ?EmailTemplate $emailTemplate = null): array
    {
        $imageFields = ['header_image', 'footer_image', 'footer_bottom_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // If updating, delete old image
                if ($emailTemplate && $emailTemplate->{$field}) {
                    Storage::disk('public')->delete($emailTemplate->{$field});
                }

                $validated[$field] = $request->file($field)->store('email-templates', 'public');
            }
        }

        return $validated;
    }

    private function filterFields(array $validated): array
    {
        if (empty($validated['header'])) {
            $validated['header_image'] = null;
            $validated['header_text'] = null;
            $validated['header_text_color'] = null;
            $validated['header_background_color'] = null;
        }

        if (empty($validated['footer'])) {
            $validated['footer_image'] = null;
            $validated['footer_text'] = null;
            $validated['footer_text_color'] = null;
            $validated['footer_background_color'] = null;
            $validated['footer_bottom_image'] = null;
        }

        return $validated;
    }
}
