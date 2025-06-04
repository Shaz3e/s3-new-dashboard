<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ForgotPasswordEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Shaz3e\EmailBuilder\Services\EmailBuilderService;

class ForgotPasswordListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

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

        $url = route('password.reset', ['email' => $event->user->email, 'token' => $token]);

        $email = new EmailBuilderService;
        $email->sendEmailBykey('forget_password', $event->user->email, [
            'name' => $event->user->name,
            'url' => $url,
            'app_name' => config('app.name'),
        ]);
    }
}
