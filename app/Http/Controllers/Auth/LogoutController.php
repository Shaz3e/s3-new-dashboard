<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        // Logout User
        Auth::logout($user);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        flash()->success(__('You have been logged out.'));

        return to_route('login');
    }
}
