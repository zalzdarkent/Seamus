<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index() {
        $ruangans = Room::all();
        return view('layouts.app', compact('ruangans'));
    }
}
