<?php

namespace App\Livewire\Admin\RolesPermissions\Roles;

use App\Livewire\BaseComponent;
use App\Models\Role;

class RolesList extends BaseComponent
{
    public $filterStatus;

    protected function getModelClass()
    {
        return Role::class;
    }

    protected function getViewName()
    {
        return 'livewire.admin.roles-permissions.roles.roles-list';
    }

    public function mount()
    {
        $this->filters = [
            'status' => $this->filterStatus,
        ];
    }

    public function updatingFilterStatus($value)
    {
        $this->filters['status'] = $value;
        $this->resetPage();
    }
}
