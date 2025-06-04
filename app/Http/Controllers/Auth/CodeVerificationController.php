<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\VerificationCodeEvent;
use App\Events\Auth\WelcomeEmailEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeVerificationController extends Controller
{
    public function verification(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            return to_route('login');
        }

        // Example: Check if the user is already verified
        if (! is_null($user->email_verified_at)) {
            flash()->success('Your account is already verified.');

            return redirect()->route('login');
        }

        $maskedEmail = $this->maskEmail($user->email);

        return view('auth.code-verification', [
            'title' => 'Code Verification',
            'maskedEmail' => $maskedEmail,
        ]);
    }

    public function store(Request $request)
    {
        $codeInput = implode('', $request->input('code')); // Combine the 4 digits into one string
        $user = Auth::user();

        if ($user->verification_code == $codeInput) {
            // Mark the user as verified
            $user->email_verified_at = now();
            /** @var \App\Models\User $user */
            $user->save();

            // Send Welcome Email
            event(new WelcomeEmailEvent($user));

            flash()->success('Welcome '.$user->name);

            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('client.dashboard');
            }
        } else {
            flash()->error('Invalid verification code.');

            return redirect()->back();
        }
    }

    public function verificationCode(Request $request)
    {
        if ($request->email && $request->code) {
            $user = User::where([
                'email' => $request->email,
                'verification_code' => $request->code,
            ])->first();

            if ($user) {
                Auth::login($user);

                return redirect()->route('verification');
            }
        }
    }

    public function resendVerificationCode(Request $request)
    {
        $user = Auth::user();

        event(new VerificationCodeEvent($user));

        flash()->success('Verification code has been sent to your email.');

        return back();
    }

    private function maskEmail($email)
    {
        $emailParts = explode('@', $email);
        $name = $emailParts[0];
        $domain = $emailParts[1];

        // Mask part of the name, leaving the first few characters visible
        $visibleLength = min(4, strlen($name)); // Show up to 4 characters
        // $maskedName = substr($name, 0, $visibleLength) . str_repeat('*', strlen($name) - $visibleLength);
        $maskedName = $name;

        return $maskedName.'@'.$domain;
    }
}
