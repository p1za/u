<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    protected $table = 'planes';
    protected $fillable = ['airline_id', 'plane_name'];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
