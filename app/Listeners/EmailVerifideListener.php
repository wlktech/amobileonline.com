<?php

namespace App\Listeners;

use App\Mail\EmailVerifiedMail;
use App\Events\EmailVerifiedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerifideListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EmailVerifiedEvent $event)
    {
        Mail::to($event->data->email)->send(new EmailVerifiedMail($event->data));
    }
}
