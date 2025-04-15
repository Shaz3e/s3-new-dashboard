<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LockedController extends Controller
{
    public function view()
    {
        $user = request()->user();
        $user->is_locked = true;
        $user->save();

        return view('auth.locked', [
            'title' => 'Your Account is Locked',
        ]);
    }

    public function post(Request $request)
    {
        $user = request()->user();

        // Validate request
        $validated = $request->validate([
            'password' => 'required|string',
        ]);

        // If user not found or password is incorrect
        if (! $user || ! password_verify($validated['password'], $user->password)) {
            flash()->error('Incorrect Password');

            return back();
        }

        // if user is not active
        if (! $user->is_active) {
            flash()->error('Your account is not active');

            return back();
        }

        // if user locked = true change to false
        $user->is_locked = false;
        $user->save();

        // Session regenrate
        session()->regenerate();

        // Authenticate and Login
        Auth::login($user);

        // Flash Message
        flash()->success('Welcome Back: '.$user->name);

        if ($user->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
    }
}
