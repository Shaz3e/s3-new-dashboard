<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create Profile with a random avatar
        $user->profile()->firstOrCreate([
            'user_id' => $user->id,
        ], [
            'avatar' => $this->randomAvatar(), // Assign a random avatar
        ]);

        // First Name and Last Name
        $user->name = $user->first_name.' '.$user->last_name;
        $user->save();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //

        // First Name and Last Name
        if ($user->isDirty('first_name') || $user->isDirty('last_name')) {
            $user->name = $user->first_name.' '.$user->last_name;
            $user->save();
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }

    /**
     * Generate a random avatar path.
     */
    private function randomAvatar(): string
    {
        // Generate a random avatar number between 1 and 15
        $avatarNumber = rand(1, 15);

        // Return the avatar path
        return 'avatars/avatar'.$avatarNumber.'.jpg';
    }
}
