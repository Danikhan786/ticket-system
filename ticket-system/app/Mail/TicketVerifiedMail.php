<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Services\QrCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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
        if ($this->ticket->qr_code_path && Storage::disk('public')->exists($this->ticket->qr_code_path)) {
            $attachments[] = Attachment::fromStorageDisk('public', $this->ticket->qr_code_path)
                ->as('ticket-qr-code.png')
                ->withMime('image/png');
        }

        return $attachments;
    }

    /**
     * Get QR code as base64 for inline display.
     */
    private function getQrCodeBase64(): ?string
    {
        if (!$this->ticket->qr_code_path || !Storage::disk('public')->exists($this->ticket->qr_code_path)) {
            return null;
        }

        $qrCodeContent = Storage::disk('public')->get($this->ticket->qr_code_path);
        return 'data:image/png;base64,' . base64_encode($qrCodeContent);
    }
}

