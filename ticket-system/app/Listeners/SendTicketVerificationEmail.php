<?php

namespace App\Listeners;

use App\Events\TicketVerified;
use App\Mail\TicketVerifiedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTicketVerificationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(TicketVerified $event): void
    {
        Mail::to($event->ticket->email)
            ->send(new TicketVerifiedMail($event->ticket));
    }
}

