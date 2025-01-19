<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'phone',
        'date',
        'status',
        'total_amount',
        'start_time',
        'end_time',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
