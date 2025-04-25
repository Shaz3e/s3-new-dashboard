<?php

namespace App\Policies;

use App\Models\GlobalEmailTemplate;
use App\Models\User;

class GlobalEmailTemplatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('global-email-templates.list');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GlobalEmailTemplate $globalEmailTemplate): bool
    {
        return $user->can('global-email-templates.read');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('global-email-templates.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GlobalEmailTemplate $globalEmailTemplate): bool
    {
        return $user->can('global-email-templates.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GlobalEmailTemplate $globalEmailTemplate): bool
    {
        return $user->can('global-email-templates.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GlobalEmailTemplate $globalEmailTemplate): bool
    {
        return $user->can('global-email-templates.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GlobalEmailTemplate $globalEmailTemplate): bool
    {
        return $user->can('global-email-templates.force.delete');
    }
}
