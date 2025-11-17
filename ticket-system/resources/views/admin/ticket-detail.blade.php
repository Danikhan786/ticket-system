@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #610B0C;
        --primary-hover: #45171A;
        --secondary-color: #7D3E39;
        --text-light: #d1ceba;
    }
    
    .ticket-detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px 20px;
    }
    
    .ticket-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .ticket-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: #ffffff;
        padding: 30px;
        text-align: center;
    }
    
    .ticket-header h1 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
    }
    
    .ticket-header .ticket-id {
        font-size: 1.2rem;
        margin-top: 10px;
        opacity: 0.9;
        letter-spacing: 2px;
    }
    
    .ticket-body {
        padding: 30px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    
    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .status-verified {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .status-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }
    
    .status-checked_in {
        background-color: #dbeafe;
        color: #1e40af;
    }
    
    .info-section {
        margin-bottom: 30px;
    }
    
    .info-section h3 {
        color: var(--primary-color);
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e0e0e0;
    }
    
    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #333;
        width: 150px;
        flex-shrink: 0;
    }
    
    .info-value {
        color: #666;
        flex: 1;
    }
    
    .qr-code-section {
        text-align: center;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-top: 30px;
    }
    
    .qr-code-section h3 {
        color: var(--primary-color);
        margin-bottom: 20px;
    }
    
    .qr-code-img {
        max-width: 300px;
        width: 100%;
        height: auto;
        border: 3px solid #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin: 0 auto 20px;
    }
    
    .screenshot-section {
        margin-top: 30px;
    }
    
    .screenshot-img {
        max-width: 100%;
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        margin-top: 15px;
    }
    
    .btn-home {
        background-color: var(--primary-color);
        color: #ffffff;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        transition: all 0.3s ease;
        border: 2px solid var(--primary-color);
    }
    
    .btn-home:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(97, 11, 12, 0.3);
    }
    
    .rejection-reason-box {
        background-color: #fee2e2;
        border-left: 4px solid #dc2626;
        padding: 15px;
        border-radius: 5px;
        margin-top: 15px;
    }
    
    .rejection-reason-box strong {
        color: #991b1b;
        display: block;
        margin-bottom: 8px;
    }
    
    .rejection-reason-box p {
        color: #7f1d1d;
        margin: 0;
    }
</style>

<div class="ticket-detail-container">
    <div class="ticket-card">
        <div class="ticket-header">
            <h1>🎫 Ticket Details</h1>
            <div class="ticket-id">{{ $ticket->ticket_id }}</div>
        </div>
        
        <div class="ticket-body">
            <div>
                <span class="status-badge status-{{ $ticket->status }}">
                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                </span>
            </div>
            
            @if($ticket->status == 'rejected' && $ticket->rejection_reason)
                <div class="rejection-reason-box">
                    <strong>Rejection Reason:</strong>
                    <p>{{ $ticket->rejection_reason }}</p>
                </div>
            @endif
            
            <div class="info-section">
                <h3>Personal Information</h3>
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
                @if($ticket->student_id)
                <div class="info-row">
                    <span class="info-label">Student ID:</span>
                    <span class="info-value">{{ $ticket->student_id }}</span>
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
        </div>
    </div>
    
    <div style="text-align: center;">
        <a href="{{ route('dashboard') }}" class="btn-home">← Back to Home</a>
    </div>
</div>
@endsection

