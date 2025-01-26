<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'plane_id',
        'departure_time',
        'arrival_time',
        'departure_city_id',
        'arrival_city_id',
        'price',
    ];

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function departureCity()
    {
        return $this->belongsTo(Kota::class, 'departure_city_id');
    }

    public function arrivalCity()
    {
        return $this->belongsTo(Kota::class, 'arrival_city_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
