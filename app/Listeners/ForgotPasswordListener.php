<?php

namespace App\Listeners;

use App\Events\ForgotPasswordEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPasswordListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ForgotPasswordEvent $event): void
    {
        $tokenExists = DB::table('password_reset_tokens')->where('email', $event->user->email)->first();

        if ($tokenExists) {
            // Delete token
            DB::table('password_reset_tokens')->where('email', $event->user->email)->delete();
        }

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $event->user->email,
            'token' => $token,
            'created_at' => now(),
        ]);
    }
}
