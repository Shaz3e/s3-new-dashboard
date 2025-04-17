<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\StoreProfileRequest;
use App\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('account-profile.index', [
            'title' => 'My Account',
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        if ($request->has('updateProfile')) {
            return $this->updateProfile(app()->make(StoreProfileRequest::class));
        }

        if ($request->has('updateAvatar')) {
            return $this->updateAvatar($request);
        }

        if ($request->has('updatePassword')) {
            return $this->updatePassword($request);
        }
    }

    private function updateProfile(StoreProfileRequest $request)
    {
        $validated = $request->validated();

        // Get current user
        $user = Auth::user();

        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        /**
         * @var App\Models\User $user
         */
        $user->save();

        $user->profile->dob = $validated['dob'];
        $user->profile->gender = $validated['gender'];
        $user->profile->phone = $validated['phone'];
        $user->profile->city = $validated['city'];
        $user->profile->state = $validated['state'];
        $user->profile->country = $validated['country'];
        $user->profile->zipcode = $validated['zipcode'];
        $user->profile->address = $validated['address'];

        $user->profile->save();

        flash()->success('Your profile has been updated.');

        return back();
    }

    private function updateAvatar(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:png,jpg|max:2048',
            'selected_avatar' => 'nullable|string',
        ]);

        // Get current user
        $user = Auth::user();
        $oldAvatar = $user->profile->avatar ?? null; // Store the old avatar path

        // Check if a new avatar file has been uploaded
        if ($request->hasFile('avatar')) {
            // Delete the old avatar from storage if it exists and is not a predefined avatar
            if ($oldAvatar && ! str_contains($oldAvatar, 'avatars/avatar')) {
                Storage::disk('public')->delete($oldAvatar);
            }

            // Store the new uploaded avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } elseif ($request->filled('selected_avatar')) {
            // Delete the old uploaded avatar from storage if switching to a predefined one
            if ($oldAvatar && ! str_contains($oldAvatar, 'avatars/avatar')) {
                Storage::disk('public')->delete($oldAvatar);
            }

            // Use the selected predefined avatar
            $avatarPath = $request->input('selected_avatar');
        } else {
            // No avatar uploaded or selected, keep the existing one
            $avatarPath = $oldAvatar;
        }

        // Remove 'selected_avatar' before updating the profile
        $updateData = Arr::except($validated, ['selected_avatar']);
        $updateData['avatar'] = $avatarPath;

        /**
         * Update the user's profile with the sanitized data
         *
         * @var App\Modeles\Profile $user
         */
        $user->profile()->updateOrCreate([], $updateData);

        // Flash a success message
        flash()->success('Your profile picture has been updated.');

        return back();
    }

    private function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => [new PasswordRule],
            'confirm_password' => 'required|same:password',
        ]);

        // Get current user
        $user = Auth::user();

        // If current password is incorrect
        if (! password_verify($validated['current_password'], $user->password)) {
            flash()->error(__('Your current password is incorrect.'));

            return back();
        }

        // If new password is same as old password
        if (password_verify($validated['password'], $user->password)) {
            flash()->error(__('New password cannot be same as old password.'));

            return back();
        }

        $user->password = bcrypt($validated['password']);

        /**
         * @var App\Models\User $user
         */
        $user->save();

        flash()->success('Your password has been changed.');

        return back();
    }
}
