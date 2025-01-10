<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{
    protected $fillable = ['name', 'category', 'photo', 'price_per_hour'];

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'facility_rooms', 'room_id', 'facility_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($room) {
            if ($room->photo) {
                // Hapus gambar dari storage
                Storage::disk('public')->delete($room->photo);
            }
        });
    }
}


// static::updating(function ($room) {
        //     // Periksa jika atribut 'photo' berubah
        //     if ($room->isDirty('photo')) {
        //         $oldPhoto = $room->getOriginal('photo');
        //         if ($oldPhoto) {
        //             Storage::delete($oldPhoto);
        //         }
        //     }
        // });