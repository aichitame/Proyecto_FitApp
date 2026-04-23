<?php

namespace App\Mail;

use App\Models\ClientRequest;
use App\Models\Plan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PlanAvailableMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public ClientRequest $clientRequest,
        public Plan $plan,
    ){
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu plan orientativo ya está disponible',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.plan-available',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
