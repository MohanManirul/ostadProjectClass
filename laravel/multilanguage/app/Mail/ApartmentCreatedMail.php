<?php

namespace App\Mail;

use App\Models\Apartment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApartmentCreatedMail extends Mailable
{
    use Queueable, SerializesModels;
    public Apartment $apartment;

    /**
     * Create a new message instance.
     */
    public function __construct(Apartment $apartment)
    {
        $this->apartment = $apartment ;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Apartment Created Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.apartment_created',
            with:[
               'apartment' =>  $this->apartment,
            ],
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
