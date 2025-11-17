@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #610B0C;
        --primary-hover: #45171A;
        --secondary-color: #7D3E39;
        --text-light: #d1ceba;
    }
    
    .page-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .custom-btn-admin {
        background-color: var(--primary-color);
        border: 2px solid var(--primary-color);
        color: #ffffff;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .custom-btn-admin:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(97, 11, 12, 0.3);
    }
    
    .custom-btn-admin.secondary {
        background-color: #7D3E39;
        border-color: #7D3E39;
    }
    
    .custom-btn-admin.secondary:hover {
        background-color: #6a342f;
        border-color: #6a342f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(125, 62, 57, 0.3);
    }
    
    .admin-section-card {
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }
    
    .table {
        border-radius: 10px;
        overflow: hidden;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
    }
    
    .table thead {
        background-color: #f8f9fa;
        border-bottom: 3px solid var(--primary-color);
    }
    
    .table thead th {
        border: none;
        padding: 15px 12px;
        font-weight: 700;
        color: #000000;
        text-align: left;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }
    
    .table tbody tr {
        transition: background-color 0.2s ease;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .table tbody tr:last-child {
        border-bottom: none;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        color: #333;
        font-size: 14px;
    }
    
    .table tbody td strong {
        color: var(--primary-color);
        font-weight: 700;
    }
    
    .d-flex.gap-2 {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .btn-sm {
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-info {
        background-color: #3b82f6;
        color: #ffffff;
    }
    
    .btn-info:hover {
        background-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        color: #ffffff;
    }
    
    .rejection-reason {
        max-width: 300px;
        word-wrap: break-word;
        color: #991b1b;
        font-style: italic;
    }
    
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        background-color: #fee2e2;
        color: #991b1b;
    }
    
    .qr-code-img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    
    .qr-code-img:hover {
        transform: scale(1.1);
        border-color: var(--primary-color);
    }
    
    .qr-code-modal-img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        color: #ffffff;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(97, 11, 12, 0.3);
        color: #ffffff;
    }
    
    .btn-secondary {
        background-color: #6b7280;
        color: #ffffff;
    }
    
    .btn-secondary:hover {
        background-color: #4b5563;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(107, 114, 128, 0.3);
        color: #ffffff;
    }
</style>

<div class="container" style="padding-top: 30px; padding-bottom: 50px;">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Rejected Tickets</h1>
            <a href="{{ route('admin.dashboard') }}" class="custom-btn-admin secondary mb-3">← Back to Dashboard</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="card admin-section-card">
                <div class="card-body" style="padding: 25px;">
                    @if($tickets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Student ID</th>
                                        <th>Department</th>
                                        <th>Semester</th>
                                        <th>Status</th>
                                        <th>Rejection Reason</th>
                                        <th>QR Code</th>
                                        <th>Transaction Screenshot</th>
                                        <th>Submitted At</th>
                                        <th>Rejected At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td><strong>{{ $ticket->ticket_id }}</strong></td>
                                            <td>{{ $ticket->name }}</td>
                                            <td>{{ $ticket->email }}</td>
                                            <td>{{ $ticket->phone ?? 'N/A' }}</td>
                                            <td>{{ $ticket->student_id ?? 'N/A' }}</td>
                                            <td>{{ $ticket->department ?? 'N/A' }}</td>
                                            <td>{{ $ticket->semester ?? 'N/A' }}</td>
                                            <td>
                                                <span class="status-badge">Rejected</span>
                                            </td>
                                            <td>
                                                <div class="rejection-reason">
                                                    {{ $ticket->rejection_reason ?? 'No reason provided' }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($ticket->qr_code_path && file_exists(public_path($ticket->qr_code_path)))
                                                    <img src="{{ asset($ticket->qr_code_path) }}" 
                                                         alt="QR Code" 
                                                         class="qr-code-img" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#qrModal{{ $ticket->id }}">
                                                    
                                                    <!-- QR Code Modal -->
                                                    <div class="modal fade" id="qrModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="qrModalLabel{{ $ticket->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="qrModalLabel{{ $ticket->id }}">QR Code - {{ $ticket->ticket_id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset($ticket->qr_code_path) }}" 
                                                                         alt="QR Code" 
                                                                         class="qr-code-modal-img">
                                                                    <p class="mt-3"><strong>Ticket ID:</strong> {{ $ticket->ticket_id }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <a href="{{ asset($ticket->qr_code_path) }}" download class="btn btn-primary">Download QR Code</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($ticket->transaction_screenshot)
                                                    <a href="{{ asset($ticket->transaction_screenshot) }}" target="_blank" class="btn btn-info btn-sm">View Screenshot</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $ticket->created_at->format('M d, Y H:i') }}</td>
                                            <td>{{ $ticket->updated_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $tickets->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">No rejected tickets found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

