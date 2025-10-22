<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaxCalculationResult extends Mailable
{
    use Queueable, SerializesModels;

    public $taxresults;
    public $username;

    /**
     * Create a new message instance.
     */
    public function __construct($taxresults)
    {
        $this->taxresults = $taxresults;
        $this->username = Auth::user()->name ?? 'User';
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('khalidmaaz766@gmail.com', 'Quick Calculate It.'),
            subject: 'Tax Calculation Result',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.tax-email',
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
