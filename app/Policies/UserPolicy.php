<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $authUser, string $targetType): bool
    {

        // If the target is USERS (admins only)
        if ($targetType === 'user') {
            return $authUser->is_admin && $authUser->can('users.list');
        }

        // If the target is CLIENTS
        if ($targetType === 'client') {
            return $authUser->can('clients.list');
        }

        return false; // Default deny
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $authUser, User $targetUser, string $targetType): bool
    {

        // If the target is USERS (admins only)
        if ($targetType === 'user') {
            return $authUser->is_admin && $authUser->can('users.read');
        }

        // If the target is CLIENTS
        if ($targetType === 'client') {
            return $authUser->can('clients.read');
        }

        return false; // Default deny
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $authUser, string $targetType): bool
    {

        // If the target is USERS (admins only)
        if ($targetType === 'user') {
            return $authUser->is_admin && $authUser->can('users.create');
        }

        // If the target is CLIENTS
        if ($targetType === 'client') {
            return $authUser->can('clients.create');
        }

        return false; // Default deny
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $targetUser, string $targetType): bool
    {

        // If the target is USERS (admins only)
        if ($targetType === 'user') {
            return $authUser->is_admin && $authUser->can('users.update');
        }

        // If the target is CLIENTS
        if ($targetType === 'client') {
            return $authUser->can('clients.update');
        }

        return false; // Default deny
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $authUser, User $targetUser, string $targetType): bool
    {

        // If the target is USERS (admins only)
        if ($targetType === 'user') {
            return $authUser->is_admin && $authUser->can('users.delete');
        }

        // If the target is CLIENTS
        if ($targetType === 'client') {
            return $authUser->can('clients.delete');
        }

        return false; // Default deny
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $authUser, User $targetUser, string $targetType): bool
    {

        // If the target is USERS (admins only)
        if ($targetType === 'user') {
            return $authUser->is_admin && $authUser->can('users.restore');
        }

        // If the target is CLIENTS
        if ($targetType === 'client') {
            return $authUser->can('clients.restore');
        }

        return false; // Default deny
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $authUser, User $targetUser, string $targetType): bool
    {

        // If the target is USERS (admins only)
        if ($targetType === 'user') {
            return $authUser->is_admin && $authUser->can('users.force.delete');
        }

        // If the target is CLIENTS
        if ($targetType === 'client') {
            return $authUser->can('clients.force.delete');
        }

        return false; // Default deny
    }
}
