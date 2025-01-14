<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{    public function create($id)
    {
        // Ambil data ruangan berdasarkan ID
        $rooms = Room::find($id);

        // Kirim data ruangan ke view
        return view('booking', compact('rooms'));
    }
}
