<?php

namespace App\Livewire\Admin\EmailTemplates;

use App\Livewire\BaseComponent;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Storage;

class EmailTemplatesList extends BaseComponent
{
    protected function getModelClass()
    {
        return EmailTemplate::class;
    }

    protected function getViewName()
    {
        return 'livewire.admin.email-templates.email-templates-list';
    }

    public function mount()
    {
        // Enable this if any additional filters are required
        // $this->filters = [
        // ];
    }

    public function confirmForceDelete($id)
    {
        $emailTemplate = EmailTemplate::withTrashed()->findOrFail($id);
        Storage::disk('public')->delete($emailTemplate->header_image);
        Storage::disk('public')->delete($emailTemplate->footer_image);
        Storage::disk('public')->delete($emailTemplate->footer_bottom_image);

        parent::confirmForceDelete($id);
    }
}
