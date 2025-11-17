<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Verified</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #610B0C;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #610B0C;
            margin: 0;
        }
        .ticket-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .ticket-info h2 {
            color: #610B0C;
            margin-top: 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .qr-code {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .qr-code img {
            max-width: 300px;
            height: auto;
            border: 2px solid #610B0C;
            border-radius: 5px;
            padding: 10px;
            background-color: #fff;
        }
        .ticket-id {
            font-size: 24px;
            font-weight: bold;
            color: #610B0C;
            text-align: center;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin: 20px 0;
            letter-spacing: 2px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #777;
            font-size: 12px;
        }
        .instructions {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
        }
        .instructions h3 {
            margin-top: 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎫 Ticket Verified!</h1>
            <p>Your ticket has been successfully verified</p>
        </div>

        @if($ticket->event)
        <div class="ticket-info">
            <h2>Event Details</h2>
            <div class="info-row">
                <span class="info-label">Event Name:</span>
                <span class="info-value">{{ $ticket->event->name }}</span>
            </div>
            @if($ticket->event->venue)
            <div class="info-row">
                <span class="info-label">Venue:</span>
                <span class="info-value">{{ $ticket->event->venue }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Start Date:</span>
                <span class="info-value">{{ $ticket->event->start_date->format('F d, Y h:i A') }}</span>
            </div>
        </div>
        @endif

        <div class="ticket-info">
            <h2>Your Information</h2>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $ticket->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $ticket->email }}</span>
            </div>
            @if($ticket->phone)
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $ticket->phone }}</span>
            </div>
            @endif
            @if($ticket->student)
            <div class="info-row">
                <span class="info-label">Student ID:</span>
                <span class="info-value">{{ $ticket->student }}</span>
            </div>
            @endif
            @if($ticket->department)
            <div class="info-row">
                <span class="info-label">Department:</span>
                <span class="info-value">{{ $ticket->department }}</span>
            </div>
            @endif
            @if($ticket->semester)
            <div class="info-row">
                <span class="info-label">Semester:</span>
                <span class="info-value">{{ $ticket->semester }}</span>
            </div>
            @endif
        </div>

        <div class="ticket-id">
            Ticket ID: {{ $ticket->ticket_id }}
        </div>

        <div style="text-align: center; margin: 20px 0;">
            <span class="status-badge">✓ Verified</span>
        </div>

        @if($qrCodeBase64)
        <div class="qr-code">
            <h3 style="color: #610B0C; margin-bottom: 15px;">Your QR Code</h3>
            <p style="margin-bottom: 15px; color: #666;">Please present this QR code at the event entrance:</p>
            <img src="{{ $qrCodeBase64 }}" alt="Ticket QR Code">
            <p style="margin-top: 15px; font-size: 12px; color: #777;">
                Verification URL: <a href="{{ $ticket->getVerificationUrl() }}" style="color: #610B0C;">{{ $ticket->getVerificationUrl() }}</a>
            </p>
        </div>
        @endif

        <div class="instructions">
            <h3>📋 Important Instructions</h3>
            <ul style="margin: 10px 0; padding-left: 20px;">
                <li>Please arrive at least 30 minutes before the event starts</li>
                <li>Bring a valid ID (CNIC) for verification</li>
                <li>Present this QR code at the entrance (digital or printed)</li>
                <li>Keep this email safe as it contains your ticket information</li>
            </ul>
        </div>

        <div class="footer">
            <p>Thank you for your registration!</p>
            <p>If you have any questions, please contact the event organizers.</p>
            <p style="margin-top: 20px;">
                <strong>Film & TV Society</strong><br>
                Institute for Art and Culture
            </p>
        </div>
    </div>
</body>
</html>

