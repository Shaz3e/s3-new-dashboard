<?php

namespace App\Livewire\Admin\EmailTemplates;

use App\Livewire\BaseComponent;
use App\Models\EmailTemplate;

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
}
