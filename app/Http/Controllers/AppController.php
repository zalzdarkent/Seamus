<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index() {
        $ruangans = Room::all();
        $facilities = Facility::count();
        $rooms = Room::count();
        $bookings = Booking::count();
        return view('layouts.app', compact('ruangans', 'facilities', 'rooms', 'bookings'));
    }
}
