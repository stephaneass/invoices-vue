<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InformationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $data)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Applican Information',
            tags: ['applican', 'information', 'laravel'],
            from: new Address($this->data->emailAddress, $this->data->firstName. " " .$this->data->lastName)
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.information',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->data->image->getRealPath())->as($this->data->image->getClientOriginalName())->withMime($this->data->image->getClientMimeType()),
            Attachment::fromPath($this->data->fileResume->getRealPath())->as($this->data->fileResume->getClientOriginalName())->withMime($this->data->fileResume->getClientMimeType()),
        ];
    }
}
