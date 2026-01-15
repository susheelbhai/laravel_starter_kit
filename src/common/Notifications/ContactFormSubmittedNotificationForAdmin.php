<?php

namespace App\Notifications;

use App\Events\ContactFormSubmitted;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormSubmittedNotificationForAdmin extends Notification implements ShouldQueue
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
        $channels = [];
        if (config('mail.send_mail') == 1 && isset($notifiable->email)) {
            $channels[] = 'mail';
        }
        if (config('whatsapp.send_msg') == 1 && isset($notifiable->phone)) {
            $channels[] = 'whatsapp';
        }
        // Always add database and broadcast (push) channels
        $channels[] = 'database';
        $channels[] = 'broadcast';
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Form Submission')
            ->markdown('mail.contact.contact-form-submitted-for-admin', [
                'data'    => $this->data
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'contact_form',
            'title' => 'New Contact Form Submission',
            'url' => route('admin.userQuery.show', $this->data['id']),
            'data' => $this->data,
        ];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return $this->toArray($notifiable);
    }

    /**
     * Get the broadcast (push) representation of the notification.
     */
    public function toBroadcast(object $notifiable)
    {
        return [
            'data' => $this->toArray($notifiable),
        ];
    }
}
