<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    public function resetForm()
    {
        return view('auth.reset-password', [
            'title' => 'Password reset',
        ]);
    }

    public function reset(PasswordResetRequest $request)
    {
        $validated = $request->validated();

        // Check token
        $token = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->exists();

        if (! $token) {
            return 'Password reset token is invalid or expired';

            return redirect()->route('login');
        }

        // Check email
        $email = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->exists();

        if (! $email) {
            return 'Password reset token is not valid for this email';

            return redirect()->route('login');
        }

        $user = User::where('email', $request->email)->first();

        $user->password = bcrypt($validated['password']);
        $user->save();

        // Delete token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return to_route('login');
    }
}
