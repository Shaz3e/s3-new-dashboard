<?php

namespace App\Policies;

use App\Models\EmailTemplate;
use App\Models\User;

class EmailTemplatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('email-templates.list');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EmailTemplate $emailTemplate): bool
    {
        return $user->can('email-templates.read');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('email-templates.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmailTemplate $emailTemplate): bool
    {
        return $user->can('email-templates.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmailTemplate $emailTemplate): bool
    {
        return $user->can('email-templates.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EmailTemplate $emailTemplate): bool
    {
        return $user->can('email-templates.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EmailTemplate $emailTemplate): bool
    {
        return $user->can('email-templates.force.delete');
    }
}
