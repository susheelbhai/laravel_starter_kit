<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Mail\UserQuery\ContactFormSubmittedMailToAdmin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\UserQuery\ContactFormSubmittedMailToUser;

class NotifyContactFormSubmitted implements ShouldQueue
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
    public function handle(ContactFormSubmitted $event): void
    {
        if (config('setting.send_mail') == 1) {
            Mail::send(new ContactFormSubmittedMailToUser($event));
            Mail::send(new ContactFormSubmittedMailToAdmin($event));
        }
    }
}
