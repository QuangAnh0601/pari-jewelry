<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendCustomerEmailVerificationNotification
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
    public function handle(object $event): void
    {
        if ($event->customer instanceof MustVerifyEmail && ! $event->customer->hasVerifiedEmail()) {
            $event->customer->sendEmailVerificationNotification();
        }
    }
}
