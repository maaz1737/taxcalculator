<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class DepreciationCalculationResult extends Mailable
{
    use Queueable, SerializesModels;

    public $depreciationResult;
    public  $yearlyResult;
    public $username;
    /**
     * Create a new message instance.
     */
    public function __construct($depreciationcreated, $yearly)
    {
        $this->depreciationResult = $depreciationcreated;
        $this->yearlyResult = $yearly;
        $this->username = Auth::user()->name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('khalidmaaz766@gmail.com', 'Quick Calculate It.'),
            subject: 'Depreciation Calculation Result',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.depreciation-email',
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
