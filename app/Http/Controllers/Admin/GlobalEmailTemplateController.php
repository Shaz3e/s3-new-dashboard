<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGlobalEmailTemplateRequest;
use App\Models\GlobalEmailTemplate;
use Illuminate\Support\Facades\Gate;
use Shaz3e\EmailBuilder\Facades\EmailBuilder;

class GlobalEmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', GlobalEmailTemplate::class);

        return view('admin.email-templates.global-email-templates.index', [
            'title' => 'Global Email Templates',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', GlobalEmailTemplate::class);

        return view('admin.email-templates.global-email-templates.create', [
            'title' => 'Create Global Header & Footer',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGlobalEmailTemplateRequest $request)
    {
        Gate::authorize('create', GlobalEmailTemplate::class);

        $validated = $request->validated();

        $globalEmailTemplate = EmailBuilder::addGlobalTemplate($validated);

        flash()->success('Global Header & Footer has been created');

        return redirect()->route('admin.global-email-templates.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(GlobalEmailTemplate $globalEmailTemplate)
    {
        Gate::authorize('view', $globalEmailTemplate);

        $globalEmailTemplate = EmailBuilder::viewGlobalEmailTemplate($globalEmailTemplate->id);

        return view('admin.email-templates.global-email-templates.show', [
            'title' => 'View Global Header & Footer',
            'globalEmailTemplate' => $globalEmailTemplate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GlobalEmailTemplate $globalEmailTemplate)
    {
        Gate::authorize('update', $globalEmailTemplate);

        return view('admin.email-templates.global-email-templates.edit', [
            'title' => 'Edit Global Header & Footer',
            'globalEmailTemplate' => $globalEmailTemplate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGlobalEmailTemplateRequest $request, GlobalEmailTemplate $globalEmailTemplate)
    {
        Gate::authorize('update', $globalEmailTemplate);

        $validated = $request->validated();

        $globalEmailTemplate = EmailBuilder::editGlobalEmailTemplate($globalEmailTemplate->id, $validated);

        flash()->success('Global Header & Footer has been updated');

        return redirect()->route('admin.global-email-templates.index');
    }
}
