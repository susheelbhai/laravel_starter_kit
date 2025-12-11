<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Events\ContactFormSubmitted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactFormSubmittedNotificationForUser;
use App\Notifications\ContactFormSubmittedNotificationForAdmin;

class SendContactFormSubmittedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(ContactFormSubmitted $user): void
    {
        $admin = Admin::first();
        $admin->notify(new ContactFormSubmittedNotificationForAdmin($user));
        $user->data->notify(new ContactFormSubmittedNotificationForUser($user));
    }
}
