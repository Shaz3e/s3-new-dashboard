<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login',[
            'title' => 'Login'
        ]);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        // Check user exists
        if (! $user) {
            flash()->error('Email is not exists in our record.');

            return back();
        }
        // Password is incorrect
        if (! password_verify($validated['password'], $user->password)) {
            flash()->error(__('Credentials does not matched'));

            return back();
        }

        // Check if user verified their email
        if (is_null($user->email_verified_at)) {

            // Generate a 4-digit random verification code
            $code = random_int(1000, 9999);

            // Save code to user's record or session for verification
            $user->verification_code = $code;
            $user->save();
        }

        // User Active false
        if (! $user->is_active) {
            flash()->error(__('Your account is not active'));

            return back();
        }

        // Check if user is suspended
        if ($user->is_suspended) {
            flash()->error('Your account is suspended please contact backoffice');

            return back();
        }

        // Unlock the user
        $user->is_locked = false;
        $user->save();

        // Check if the "Remember Me" checkbox is checked
        $remember = $request->has('remember');

        // Login with the remember token
        Auth::login($user, $remember);

        // If the login is successful, redirect to the dashboard
        $request->session()->regenerate();

        flash()->success('Welcome '.$user->name);

        return redirect()->route('admin.dashboard');
    }
}
