<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Authorize the action to view any user
        Gate::authorize('viewAny', [User::class, 'user']);

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Authorize the action to create a new user
        Gate::authorize('create', [User::class, 'user']);

        // Get all active roles
        $roles = Role::where('active', true)
            ->pluck('name', 'name')
            ->all();

        return view('admin.users.create', [
            'title' => 'Create New User',
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Authorize the action to create a new user
        Gate::authorize('create', [User::class, 'user']);

        // Validate the request data
        // This will validate the request data based on the validation rules defined in the StoreUserRequest class
        $validated = $request->validated();

        // Set the email_verified_at timestamp to now() if the email_verified_at
        // select value is selected, otherwise set it to null
        $validated['email_verified_at'] = $request->email_verified_at ? now() : null;

        // Create a new user instance using the validated data
        // The create method will hash the password and create a new user record
        // in the database.
        $user = User::create($validated);

        // Set the user's is_admin property to true if the request contains the
        // is_admin parameter. This is useful for creating an admin user.
        $user->is_admin = true;
        $user->save();

        // If roles are provided, sync them with the user
        // This is useful if you want to assign roles to a user
        // immediately after creating them
        if ($request->roles) {
            $user->syncRoles($request->roles);

            // Redirect to the user's show page
            // This is useful if you want to assign roles to a user
            // and then redirect to the user's show page
            // return redirect()->route('admin.users.show', $user);
        }

        flash()->success(__('User has been created successfully'));

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // The Gate facade provides a convenient interface for managing authorization
        // and checking permissions in the application. We use it to check if the
        // current user can view the user with the given ID.
        Gate::authorize('view', [$user, 'user']);

        return view('admin.users.show', [
            'title' => 'View User',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Authorize the action to edit a user
        // This gate is used to protect against unauthorized access to the user edit form
        Gate::authorize('update', [$user, 'user']);

        // Check if the user ID is within a restricted list
        if (in_array($user->id, [1, 2, 3])) {
            // Flash an error message if the user is not found
            flash()->error('Record not found');

            // Redirect to the user index route
            return to_route('admin.users.index');
        }

        // Get all active roles
        $roles = Role::where('active', true)
            ->pluck('name', 'name')
            ->all();

        // Get the roles associated with the user
        // This will be used to pre-select the roles in the edit form
        $userRoles = $user->roles()->pluck('name', 'name')->all();

        // Return the edit view with the user instance, roles, and the user's roles
        // This view is only accessible by an authorized user with the 'update' permission
        return view('admin.users.edit', [
            // The title of the page
            'title' => __('Edit User'),
            // The user instance
            'user' => $user,
            // All the active roles in the system
            'roles' => $roles,
            // The roles associated with the user
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Authorize the action to update a user
        // This gate is used to protect against unauthorized access to the user update form
        Gate::authorize('update', [$user, 'user']);

        // Check if the user ID is within a restricted list
        // If it is, flash an error message and redirect to the user index route
        if (in_array($user->id, [1, 2, 3])) {
            flash()->error('Record not found');

            return to_route('admin.users.index');
        }

        // Handle form submission for personal information
        // Call the personalInformation method to update the user's personal information
        if ($request->has('personalInformation')) {
            return $this->personalInformation($request, $user);
        }

        // Handle form submission for contact information
        // Call the contactInformation method to update the user's contact information
        if ($request->has('contactInformation')) {
            return $this->contactInformation($request, $user);
        }

        // Handle form submission for updating avatar
        // Call the updateAvatar method to update the user's avatar
        if ($request->has('updateAvatar')) {
            return $this->updateAvatar($request, $user);
        }

        // Handle form submission for updating password
        // Call the updatePassword method to update the user's password
        if ($request->has('updatePassword')) {
            return $this->updatePassword($request, $user);
        }

        // Handle form submission for updating roles
        // Call the syncRoles method to update the user's roles
        if ($request->roles) {
            $user->syncRoles($request->roles);
            flash()->success('Role Synced');

            return back();
        }
    }

    /**
     * Handle the personal information update request.
     *
     * This method is called when the user submits the personal information form.
     * It validates the request data, updates the user's personal information,
     * and flashes a success message.
     *
     * @param  Request  $request  The request object containing the form data
     * @param  User  $user  The user instance to be updated
     * @return RedirectResponse The redirect response to the previous page
     */
    private function personalInformation(Request $request, User $user)
    {
        // Validate the request data
        // This will validate the request data based on the validation rules defined below
        // The `validate` method will throw a `ValidationException` if the validation fails
        // The `validate` method will return the validated data
        $validated = $request->validate([
            // The first name of the user is required and must be a string
            // The first name must not be longer than 100 characters
            'first_name' => 'required|string|max:100',

            // The last name of the user is required and must be a string
            // The last name must not be longer than 100 characters
            'last_name' => 'required|string|max:100',

            // The email address of the user is required and must be a valid email address
            // The email address must not be longer than 100 characters
            // The email address must be unique in the database, excluding the current user
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        // Update the user's details
        // The `update` method will update the user's details
        // The `save` method will save the user's details to the database
        $user->update($validated);

        $user->profile()->update([
            'dob' => $request->dob,
        ]);

        // Flash a success message
        // The `success` method will flash a success message
        // The message will be displayed to the user
        flash()->success('User personal details have been updated.');

        // Redirect the user back to the previous page
        // The `back` method will redirect the user back to the previous page
        return back();
    }

    /**
     * Handle the contact information update request.
     *
     * This method is called when the user submits the contact information form.
     * It validates the request data, updates the user's contact information,
     * and flashes a success message.
     *
     * @param  Request  $request  The request object containing the form data
     * @param  User  $user  The user instance to be updated
     * @return RedirectResponse The redirect response to the previous page
     */
    private function contactInformation(Request $request, User $user)
    {
        // Validate the request data
        // The `validate` method will throw a `ValidationException` if validation fails
        // The `validate` method will return the validated data
        $validated = $request->validate([
            // The phone number is optional and must not be longer than 20 characters
            'phone' => 'nullable|max:20',

            // The country name is optional, must be a string, and not longer than 100 characters
            'country' => 'nullable|string|max:100',

            // The state name is optional, must be a string, and not longer than 100 characters
            'state' => 'nullable|string|max:100',

            // The city name is optional, must be a string, and not longer than 100 characters
            'city' => 'nullable|string|max:100',

            // The zipcode is optional, must be a string, and not longer than 10 characters
            'zipcode' => 'nullable|string|max:10',

            // The address is optional, must be a string, and not longer than 255 characters
            'address' => 'nullable|string|max:255',
        ]);

        // Update the user's profile with the validated data
        $user->profile()->update($validated);

        // Flash a success message to indicate the contact information has been updated
        flash()->success('User contact details have been updated.');

        // Redirect the user back to the previous page
        return back();
    }

    /**
     * Update the user's avatar.
     *
     * This method handles the update of the user's avatar, either by uploading a new image
     * or selecting a predefined avatar. It ensures that any existing avatar is managed
     * appropriately by deleting old avatars when necessary.
     *
     * @param  Request  $request  The request object containing the form data
     * @param  User  $user  The user instance whose avatar is to be updated
     * @return RedirectResponse The redirect response to the previous page
     */
    private function updateAvatar(Request $request, User $user)
    {
        // Validate the request data for avatar and selected_avatar
        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:png,jpg|max:2048',
            'selected_avatar' => 'nullable|string',
        ]);

        // Retrieve the old avatar path, if it exists
        $oldAvatar = $user->profile->avatar ?? null;

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

        // Prepare the data for updating the profile, excluding 'selected_avatar'
        $updateData = Arr::except($validated, ['selected_avatar']);
        $updateData['avatar'] = $avatarPath;

        // Update or create the user's profile with the sanitized data
        $user->profile()->updateOrCreate([], $updateData);

        // Flash a success message to indicate the avatar has been updated
        flash()->success('User profile picture has been updated.');

        // Redirect the user back to the previous page
        return back();
    }

    /**
     * Update the user's password.
     *
     * This method handles the password update request. It validates the provided
     * password using the PasswordRule and updates the user's password in the database.
     * A success message is flashed upon successful update.
     *
     * @param  Request  $request  The request object containing the form data
     * @param  User  $user  The user instance whose password is to be updated
     * @return RedirectResponse The redirect response to the previous page
     */
    private function updatePassword(Request $request, User $user)
    {
        // Validate the request data
        // The `validate` method will ensure the password meets the requirements
        $validated = $request->validate([
            'password' => [new PasswordRule],
        ]);

        // Update the user's password with the validated data
        $user->update($validated);

        // Flash a success message to indicate the password has been updated
        flash()->success('Password has been updated');

        // Redirect the user back to the previous page
        return back();
    }
}
