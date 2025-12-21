<?php

namespace App\Listeners;

use App\Events\PartnerCreated;
use App\Notifications\PartnerCreatedNotificationForPartner;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPartnerCreatedNotification
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
    public function handle(PartnerCreated $user): void
    {
        $user->data->notify(new PartnerCreatedNotificationForPartner($user));
    }
}
