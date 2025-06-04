<?php

namespace App\Listeners\Auth;

use App\Events\Auth\VerificationCodeEvent;
use Shaz3e\EmailBuilder\Services\EmailBuilderService;

class VerificationCodeListener
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
    public function handle(VerificationCodeEvent $event): void
    {
        // generate 4 digits code
        $code = mt_rand(1000, 9999);

        // save code
        $event->user->verification_code = $code;
        $event->user->saveQuietly();

        $email = new EmailBuilderService;
        $email->sendEmailBykey('verification_code', $event->user->email, [
            'name' => $event->user->name,
            'code' => $code,
            'app_name' => config('app.name'),
        ]);
    }
}
