<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\WelcomeEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        event(new WelcomeEmailEvent($user));

        flash()->success('You have successfully registered');

        return redirect()->route('verification');
    }
}
