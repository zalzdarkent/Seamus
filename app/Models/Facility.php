<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    protected $fillable = ['name', 'qty'];
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'facility_rooms', 'facility_id', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
