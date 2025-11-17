@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #610B0C;
        --primary-hover: #45171A;
        --secondary-color: #7D3E39;
        --text-light: #d1ceba;
        --bg-light: #f0f8ff;
    }
    
    .admin-card {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(97, 11, 12, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(97, 11, 12, 0.3);
    }
    
    .admin-card.pending {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }
    
    .admin-card.verified {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    
    .admin-card.checked-in {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }
    
    .admin-card.rejected {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }
    
    .admin-card h5 {
        color: var(--text-light);
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .admin-card h2 {
        color: #ffffff;
        font-weight: 700;
        font-size: 2.5rem;
    }
    
    .custom-btn-admin {
        background-color: var(--primary-color);
        border: 2px solid var(--primary-color);
        color: #ffffff;
        padding: 10px 25px;
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
    
    .custom-btn-admin.info {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: 2px solid #3b82f6;
    }
    
    .custom-btn-admin.info:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .admin-section-card {
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }
    
    .admin-section-card .card-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: #ffffff;
        border-radius: 15px 15px 0 0;
        padding: 15px 20px;
        border: none;
    }
    
    .admin-section-card .card-header h5 {
        color: #ffffff;
        margin: 0;
        font-weight: 600;
    }
    
    .page-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 30px;
    }
</style>

<div class="container" style="padding-top: 30px; padding-bottom: 50px;">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Admin Dashboard</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card admin-card">
                <div class="card-body">
                    <h5 class="card-title">Total Tickets</h5>
                    <h2 id="total-tickets">{{ $totalTickets }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card admin-card pending">
                <div class="card-body">
                    <h5 class="card-title">Pending Tickets</h5>
                    <h2 id="pending-tickets">{{ $pendingTickets }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card admin-card verified">
                <div class="card-body">
                    <h5 class="card-title">Verified Tickets</h5>
                    <h2 id="verified-tickets">{{ $verifiedTickets }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card admin-card rejected">
                <div class="card-body">
                    <h5 class="card-title">Rejected Tickets</h5>
                    <h2 id="rejected-tickets">{{ $rejectedTickets }}</h2>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3 mb-3">
            <div class="card admin-card checked-in">
                <div class="card-body">
                    <h5 class="card-title">Checked In</h5>
                    <h2 id="checked-in-tickets">{{ $checkedInTickets }}</h2>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card admin-section-card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body" style="padding: 25px;">
                    <a href="{{ route('admin.tickets.index') }}" class="custom-btn-admin secondary me-2 mb-2">View All Tickets</a>
                    <a href="{{ route('admin.tickets.pending') }}" class="custom-btn-admin me-2 mb-2">View Pending Tickets</a>
                    <a href="{{ route('admin.tickets.rejected') }}" class="custom-btn-admin me-2 mb-2" style="background-color: #ef4444; border-color: #ef4444;">View Rejected Tickets</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

