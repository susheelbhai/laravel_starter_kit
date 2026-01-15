<?php

namespace App\Notifications;

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
        $channels = ['database', 'broadcast'];
        if (config('mail.send_mail') == 1 && isset($notifiable->email)) {
            $channels[] = 'mail';
        }
        if (config('whatsapp.send_msg') == 1 && isset($notifiable->phone)) {
            $channels[] = 'whatsapp';
        }
        return $channels;
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
        return [
            'type' => 'product_enquiry',
            'title' => 'New Product Enquiry Received',
            'url' => route('admin.productEnquiry.show', $this->data['id']),
            'data' => $this->data,
        ];
    }
}
