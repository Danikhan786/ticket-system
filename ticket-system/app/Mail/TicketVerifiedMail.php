<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class TicketVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Ticket $ticket
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $eventName = $this->ticket->event ? $this->ticket->event->name : 'Event';
        return new Envelope(
            subject: 'Your Ticket Has Been Verified - ' . $eventName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket-verified',
            with: [
                'ticket' => $this->ticket,
                'qrCodeBase64' => $this->getQrCodeBase64(),
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
        $attachments = [];

        // Attach QR code if exists
        if ($this->ticket->qr_code_path) {
            $qrCodeFullPath = public_path($this->ticket->qr_code_path);
            
            if (file_exists($qrCodeFullPath)) {
                // Determine file extension and MIME type
                $extension = pathinfo($qrCodeFullPath, PATHINFO_EXTENSION);
                $mimeType = $extension === 'svg' ? 'image/svg+xml' : 'image/png';
                $filename = 'ticket-qr-code.' . ($extension ?: 'png');
                
                $attachments[] = Attachment::fromPath($qrCodeFullPath)
                    ->as($filename)
                    ->withMime($mimeType);
            }
        }

        return $attachments;
    }

    /**
     * Get QR code as base64 for inline display.
     */
    private function getQrCodeBase64(): ?string
    {
        if (!$this->ticket->qr_code_path) {
            return null;
        }

        $qrCodeFullPath = public_path($this->ticket->qr_code_path);
        
        if (!file_exists($qrCodeFullPath)) {
            return null;
        }

        $qrCodeContent = file_get_contents($qrCodeFullPath);
        
        // Determine MIME type based on file extension
        $extension = pathinfo($qrCodeFullPath, PATHINFO_EXTENSION);
        $mimeType = $extension === 'svg' ? 'image/svg+xml' : 'image/png';
        
        return 'data:' . $mimeType . ';base64,' . base64_encode($qrCodeContent);
    }
}

