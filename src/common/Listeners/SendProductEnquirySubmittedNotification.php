<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Events\ProductEnquirySubmitted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductEnquirySubmittedNotificationForUser;
use App\Notifications\ProductEnquirySubmittedNotificationForAdmin;

class SendProductEnquirySubmittedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(ProductEnquirySubmitted $enquiry): void
    {
        $admin = Admin::first();
        $admin->notify(new ProductEnquirySubmittedNotificationForAdmin($enquiry));
        $enquiry->data->notify(new ProductEnquirySubmittedNotificationForUser($enquiry));
    }
}
