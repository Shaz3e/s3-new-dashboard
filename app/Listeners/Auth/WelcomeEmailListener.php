<?php

namespace App\Listeners\Auth;

use App\Events\Auth\WelcomeEmailEvent;
use Shaz3e\EmailBuilder\Services\EmailBuilderService;

class WelcomeEmailListener
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
    public function handle(WelcomeEmailEvent $event): void
    {
        $email = new EmailBuilderService;
        $email->sendEmailBykey('welcome_email', $event->user->email, [
            'app_name' => config('app.name'),
            'name' => $event->user->name,
            'app_url' => config('app.url'),
        ]);
    }
}
