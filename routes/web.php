<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\BookingController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('index');
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking');

