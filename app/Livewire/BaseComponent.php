<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseComponent extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    #[Url()]
    public $perPage = 10;

    public $recordToDelete;

    public $showDeleted = false;

    // Additional filter variables
    public $filters = [];

    abstract protected function getModelClass();

    /**
     * Render the component
     */
    public function render()
    {
        $model = $this->getModelClass();
        $query = $model::query();

        $columns = Schema::getColumnListing((new $model)->getTable());

        if ($this->search !== '') {
            $query->where(function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%'.$this->search.'%');
                }
            });
        }

        if ($this->showDeleted) {
            $query->onlyTrashed();
        }

        // Handle custom filters
        foreach ($this->filters as $filter => $value) {
            if (! empty($value)) {
                $query->where($filter, $value);
            }
        }

        // Apply additional constraints defined in child components
        $this->applyAdditionalConstraints($query);

        $records = $query->orderByDesc('id')->paginate($this->perPage);

        return view($this->getViewName(), ['records' => $records]);
    }

    /**
     * Override this method in child components to add custom query constraints
     */
    protected function applyAdditionalConstraints($query)
    {
        // This method can be overridden in child classes to add specific constraints
    }

    /**
     * Get the view name dynamically
     */
    abstract protected function getViewName();

    /**
     * Handle search query update
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function toggleStatus($id, $field)
    {
        $model = $this->getModelClass();
        $record = $model::find($id);

        // Check if the field exists in the model
        if ($record && array_key_exists($field, $record->getAttributes())) {
            $record->$field = ! $record->$field;
            $record->save();

            // Dispatch status changed event
            $this->dispatch('statusChanged');
        }
    }

    /**
     * Delete record
     */
    public function confirmDelete($id)
    {
        $this->recordToDelete = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    #[On('deleteConfirmed')]
    public function delete()
    {
        $model = $this->getModelClass();

        $record = $model::find($this->recordToDelete);
        if ($record) {
            $record->delete();
            $this->recordToDelete = null;
        }
    }

    /**
     * Restore deleted record
     */
    public function confirmRestore($id)
    {
        $this->recordToDelete = $id;
        $this->dispatch('confirmRestore');
    }

    #[On('restored')]
    public function restore()
    {
        $model = $this->getModelClass();
        $model::withTrashed()->find($this->recordToDelete)->restore();
        $this->recordToDelete = null;
    }

    /**
     * Force delete record
     */
    public function confirmForceDelete($id)
    {
        $this->recordToDelete = $id;
        $this->dispatch('confirmForceDelete');
    }

    #[On('forceDeleted')]
    public function forceDelete()
    {
        $model = $this->getModelClass();
        $model::withTrashed()->find($this->recordToDelete)->forceDelete();
        $this->recordToDelete = null;
    }
}
