<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'logo',
        'payment_name',
        'payment_to',
        'payment_number',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
