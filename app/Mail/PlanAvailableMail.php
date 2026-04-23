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

class PlanAvailableMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ClientRequest $clientRequest,
        public Plan $plan,
    ){
    }

    public function build(): static {
        return $this
        ->subject('Tu plan orientativo ya está disponible')
        ->view('emails.plan-available', [
            'clientRequest' => $this->clientRequest,
            'plan' => $this->plan,
        ]);
    }
}
