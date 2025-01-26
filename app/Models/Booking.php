<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = ['booking_code', 'user_id', 'schedule_id', 'seat_id', 'payment_id', 'payment_proof', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
