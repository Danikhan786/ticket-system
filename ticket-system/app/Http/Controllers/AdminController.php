<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Events\TicketVerified;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketVerifiedMail;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Get dashboard statistics.
     *
     * @return JsonResponse|\Illuminate\View\View
     */
    public function dashboard()
    {
        $totalTickets = Ticket::count();
        $pendingTickets = Ticket::where('status', 'pending')->count();
        $verifiedTickets = Ticket::where('status', 'verified')->count();
        $rejectedTickets = Ticket::where('status', 'rejected')->count();
        return view('admin.dashboard', compact('totalTickets', 'pendingTickets', 'verifiedTickets', 'rejectedTickets'));
    }

    /**
     * Display pending tickets.
     *
     * @return \Illuminate\View\View
     */
    public function pendingTickets()
    {
        $tickets = Ticket::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.pending-tickets', compact('tickets'));
    }

    /**
     * Display rejected tickets.
     *
     * @return \Illuminate\View\View
     */
    public function rejectedTickets()
    {
        $tickets = Ticket::where('status', 'rejected')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.rejected-tickets', compact('tickets'));
    }

    /**
     * Display all tickets.
     *
     * @return \Illuminate\View\View
     */
    public function allTickets(Request $request)
    {
        $query = Ticket::query();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.all-tickets', compact('tickets'));
    }

    /**
     * Verify a ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        if ($ticket->status !== 'pending') {
            return redirect()->back()->with('error', 'Ticket is not in pending status.');
        }
        
        // Generate verification token
        $ticket->verification_token = Str::uuid()->toString();
        $ticket->status = 'verified';
        $ticket->verified_at = now();
        $ticket->save();
        
        // Dispatch event to send email
        event(new TicketVerified($ticket));
        
        return redirect()->back()->with('success', 'Ticket verified successfully! Email sent to student.');
    }

    /**
     * Reject a ticket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectTicket(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);
        
        $ticket = Ticket::findOrFail($id);
        
        if ($ticket->status !== 'pending') {
            return redirect()->back()->with('error', 'Ticket is not in pending status.');
        }
        
        $ticket->status = 'rejected';
        $ticket->rejection_reason = $request->rejection_reason;
        $ticket->save();
        
        return redirect()->back()->with('success', 'Ticket rejected successfully.');
    }

    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        
        return view('admin.ticket-detail', compact('ticket'));
    }
}

