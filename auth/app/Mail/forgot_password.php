<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

class forgot_password extends Mailable
{
    use Queueable, SerializesModels;


    private $email = '';
    private $token = '';
    private $domain = '';

    /**
     * Create a new message instance.
     */
    public function __construct($email, $token,$domain)
    {
        //
        $this->email = $email;
        $this->token = $token;
        $this->domain = $domain;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('admin@gmail.com', 'opad'), //can change using env variable
            subject: 'Forgot Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $resetLink = $this->domain . '/reset?token=' .  $this->token.'&email='. $this->email;

        return new Content(
            view: 'email.forgot_password',
            with: [
                'link' => $resetLink,
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
