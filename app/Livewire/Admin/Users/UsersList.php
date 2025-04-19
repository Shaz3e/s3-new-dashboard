<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\BaseComponent;
use App\Models\User;
use Livewire\Attributes\Url;

class UsersList extends BaseComponent
{
    #[Url()]
    public $filterActive;

    #[Url()]
    public $filterSuspended;

    protected function getModelClass()
    {
        return User::class;
    }

    protected function getViewName()
    {
        return 'livewire.admin.users.users-list';
    }

    public function mount()
    {
        $this->filters = [
            'is_active' => $this->filterActive,
            'is_suspended' => $this->filterSuspended,
        ];
    }

    protected function applyAdditionalConstraints($query)
    {
        // Apply is_admin = 1 filter
        $query->where('is_admin', true);

        if (isset($this->filters['is_active']) && $this->filters['is_active'] !== '') {
            // Apply the filter only if it's not an empty value
            $query->where('is_active', $this->filters['is_active']);
        }
        if (isset($this->filters['is_suspended']) && $this->filters['is_suspended'] !== '') {
            // Apply the filter only if it's not an empty value
            $query->where('is_suspended', $this->filters['is_suspended']);
        }

        $query->sortedBy();
    }

    public function updatingFilterActive($value)
    {
        $this->filters['is_active'] = $value;
        $this->resetPage();
    }

    public function updatingFilterSuspended($value)
    {
        $this->filters['is_suspended'] = $value;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterActive = '';
        $this->filterSuspended = '';
        $this->filters = [];
        $this->showDeleted = false;
        $this->resetPage();
    }
}
