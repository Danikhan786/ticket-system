<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VerificationController;

Auth::routes();

// Frontend routes
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/form', [FrontendController::class, 'form'])->name('form');
Route::post('/ticket', [FrontendController::class, 'store'])->name('tickets.store');


// Admin panel routes (protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/tickets/pending', [AdminController::class, 'pendingTickets'])->name('tickets.pending');
    Route::get('/tickets/rejected', [AdminController::class, 'rejectedTickets'])->name('tickets.rejected');
    Route::get('/tickets', [AdminController::class, 'allTickets'])->name('tickets.index');
    Route::get('/tickets/{ticket_id}', [AdminController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/verify', [AdminController::class, 'verifyTicket'])->name('tickets.verify');
    Route::post('/tickets/{id}/reject', [AdminController::class, 'rejectTicket'])->name('tickets.reject');
});

Route::get('/home', [HomeController::class, 'home'])->name('home');
