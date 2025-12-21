<?php

namespace App\Listeners;

use App\Events\SellerCreated;
use App\Notifications\SellerCreatedNotificationForSeller;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSellerCreatedNotification
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
    public function handle(SellerCreated $user): void
    {
        $user->data->notify(new SellerCreatedNotificationForSeller($user));

    }
}
