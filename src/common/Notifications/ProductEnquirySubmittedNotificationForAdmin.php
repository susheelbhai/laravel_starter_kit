<?php

namespace App\Notifications;

use App\Events\ProductEnquirySubmitted;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductEnquirySubmittedNotificationForAdmin extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($event)
    {
        $this->data = $event->data;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Product Enquiry Received')
            ->markdown('mail.product.product-enquiry-submitted-for-admin', [
                'data' => $this->data
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
