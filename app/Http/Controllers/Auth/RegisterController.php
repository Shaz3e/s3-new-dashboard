<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Shaz3e\EmailBuilder\Services\EmailBuilderService;

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

        $email = new EmailBuilderService;
        $email->sendEmailBykey('welcome_email', $user->email, [
            'app_name' => config('app.name'),
            'name' => $user->name,
            'app_url' => config('app.url'),
        ]);

        flash()->success('You have successfully registered');

        return redirect()->route('login');
    }
}
