<?php

namespace App\Listeners;

use App\Events\TicketVerified;
use App\Mail\TicketVerifiedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendTicketVerificationEmail
{
    /**
     * Handle the event.
     */
    public function handle(TicketVerified $event): void
    {
        try {
            // Refresh ticket to ensure we have latest data
            $event->ticket->refresh();
            
            Mail::to($event->ticket->email)
                ->send(new TicketVerifiedMail($event->ticket));
                
            Log::info('Verification email sent successfully', [
                'ticket_id' => $event->ticket->id,
                'email' => $event->ticket->email
            ]);
        } catch (\Exception $e) {
            // Log error but don't fail the verification
            Log::error('Failed to send verification email', [
                'ticket_id' => $event->ticket->id,
                'email' => $event->ticket->email,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
        }
    }
}

