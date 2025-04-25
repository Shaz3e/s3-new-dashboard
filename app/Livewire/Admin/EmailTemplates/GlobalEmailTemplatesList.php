<?php

namespace App\Livewire\Admin\EmailTemplates;

use App\Livewire\BaseComponent;
use App\Models\GlobalEmailTemplate;

class GlobalEmailTemplatesList extends BaseComponent
{
    protected function getModelClass()
    {
        return GlobalEmailTemplate::class;
    }

    protected function getViewName()
    {
        return 'livewire.admin.email-templates.global-email-templates-list';
    }

    public function mount()
    {
        // Enable this if any additional filters are required
        // $this->filters = [
        // ];
    }
}
