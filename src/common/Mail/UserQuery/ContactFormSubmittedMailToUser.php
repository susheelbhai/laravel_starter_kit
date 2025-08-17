<?php

namespace App\Mail\UserQuery;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormSubmittedMailToUser extends Mailable
{
    use Queueable, SerializesModels;

    
    public $data;
    public function __construct($data)
    {
        $this->data = $data->data;
    }

    
    public function envelope(): Envelope
    {
        return new Envelope(
            to: [new Address($this->data['email'], $this->data['name']),],
            subject: 'Thank you for contacting getvet',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.user-query.contact-form-submitted-mail-to-user',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
