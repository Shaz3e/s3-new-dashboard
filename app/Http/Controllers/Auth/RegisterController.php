<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        flash()->success('You have successfully registered');

        Auth::login($user);

        return redirect()->route('verification');
    }
}
