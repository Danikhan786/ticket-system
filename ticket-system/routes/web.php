<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;

Auth::routes();
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'home'])->name('home');
