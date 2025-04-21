<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientRequest;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Models\Profile;
use App\Models\User;
use App\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', [User::class, 'client']);

        return view('admin.clients.index', [
            'title' => __('Client List'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', [User::class, 'client']);

        return view('admin.clients.create', [
            'title' => __('Create New Client'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        Gate::authorize('create', [User::class, 'client']);

        $validated = $request->validated();

        // Set email_verified_at to null if not verified, otherwise set to current timestamp
        $validated['email_verified_at'] = $request->email_verified_at ? now() : null;

        // Create the user
        $user = User::create($validated);

        flash()->success(__('Client has been created'));

        return redirect()->route('admin.clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $client)
    {
        Gate::authorize('view', [$client, 'client']);

        if (isset($request->status)) {
            $client->is_active = $request->status == 1;
        }

        if (isset($request->suspended)) {
            $client->is_suspended = $request->suspended == 1;
        }

        if (isset($request->verified)) {
            $client->email_verified_at = $request->verified == 1 ? now() : null;
        }

        $client->save();

        return to_route('admin.clients.edit', $client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $client)
    {
        Gate::authorize('update', [$client, 'client']);

        return view('admin.clients.edit', [
            'title' => __('Edit Client'),
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $client)
    {
        Gate::authorize('update', [$client, 'client']);

        if ($request->has('personalInformation')) {
            return $this->personalInformation($request, $client);
        }

        if ($request->has('additionalInformation')) {
            return $this->additionalInformation(app()->make(StoreProfileRequest::class), $client);
        }

        if ($request->has('contactInformation')) {
            return $this->contactInformation($request, $client);
        }

        if ($request->has('updateAvatar')) {
            return $this->updateAvatar($request, $client);
        }

        if ($request->has('updatePassword')) {
            return $this->updatePassword($request, $client);
        }
    }

    private function personalInformation(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'nullable|string|max:65|unique:users,username,'.$user->id,
        ]);

        $user->update($validated);

        // if gender and dob update file
        if ($request->has('gender') || $request->has('dob')) {

            $validated = $request->validate([
                'gender' => [
                    'required',
                    Rule::in(Profile::getGenderTypes()),
                ],
                'dob' => [
                    'required',
                    'date',
                ],
            ]);

            $user->profile()->update($validated);
        }

        // Flash a success message
        flash()->success('Client personal details have been updated.');

        return back();
    }

    private function additionalInformation(StoreProfileRequest $request, User $user)
    {
        $validated = $request->validated(); // Define the file fields to process
        $fileFields = ['id_front', 'id_back', 'id_address_proof'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete the existing file if it exists
                if ($user->$field) {
                    Storage::disk('public')->delete($user->$field);
                }

                // Store the new uploaded file and update the path
                $validated[$field] = $request->file($field)->store('kyc-profiles', 'public');
            }
        }

        $user->profile()->update($validated);

        flash()->success('Client additional information has been updated');

        return back();
    }

    private function contactInformation(Request $request, User $user)
    {
        $validated = $request->validate([
            'phone' => 'nullable|max:20',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
        ]);

        // Update the user's profile with the sanitized data
        $user->profile()->update($validated);

        // Flash a success message
        flash()->success('Client personal details have been updated.');

        return back();
    }

    private function updateAvatar(Request $request, User $user)
    {
        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:png,jpg|max:2048',
            'selected_avatar' => 'nullable|string',
        ]);

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

        // Update the user's profile with the sanitized data
        $user->profile()->updateOrCreate([], $updateData);

        // Flash a success message
        flash()->success('User profile picture has been updated.');

        return back();
    }

    private function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => [new PasswordRule],
        ]);

        $user->update($validated);

        flash()->success('Password has been updated');

        return back();
    }

    public function loginAsClient(User $client)
    {
        // Ensure the current user is an admin
        if (! Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Ensure the target user is a client
        if ($client->is_admin) {
            abort(403, 'Cannot impersonate another admin.');
        }

        // Save the admin's ID to session for later
        session()->put('admin_id', Auth::id());

        // Save impersonation ID in session
        session()->put('impersonate', $client->id);

        // Log in as the client user
        Auth::loginUsingId($client->id);

        return redirect()
            ->route('client.dashboard')
            ->with(
                'success',
                'You are now logged in as '.$client->name
            );
    }

    public function stopImpersonating()
    {
        if (! session()->has('admin_id')) {
            return redirect('/')->with('error', 'Not impersonating any user.');
        }

        // Retrieve admin ID and clear session
        $adminId = session()->pull('admin_id');
        session()->forget('impersonate');

        // Log back in as admin
        Auth::loginUsingId($adminId);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'You have returned to your staff account.');
    }
}
