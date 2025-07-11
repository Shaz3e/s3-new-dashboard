<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\ForgotPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function forgotPasswordForm()
    {
        return view('auth.forgot-password', [
            'title' => 'Forget password',
        ]);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        event(new ForgotPasswordEvent($user));

        flash()->success('Email sent successfully');

        return redirect()->route('login');
    }
}
