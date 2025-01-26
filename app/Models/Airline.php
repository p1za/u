<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $table = 'airlines';
    protected $fillable = ['airline_name', 'airline_code', 'country', 'status', 'logo'];

    public function planes()
    {
        return $this->hasMany(Plane::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
