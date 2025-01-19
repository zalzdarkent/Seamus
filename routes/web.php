<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\BookingController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('index');
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking');
Route::post('/booking', [BookingController::class, 'booking'])->name('proses.booking');
Route::get('/booking/invoice/{id}', [BookingController::class, 'invoice']);
