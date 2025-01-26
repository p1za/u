<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'plane_id',
        'seat_number',
    ];

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
