<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            $scheduleCount = Schedule::count();
            $passengerCount = User::where('role', 'passenger')->count();
            $bookingCount = Booking::count();
            $airlines = Airline::all();
            return view('admin.dashboard', compact('scheduleCount', 'passengerCount', 'airlines', 'bookingCount'));
        } elseif ($role === 'passenger') {
            $schedules = Schedule::where('departure_time', '>=', now())->paginate(5);
            $bookings = Booking::where('user_id', auth()->id())->get();
            return view('passenger.dashboard', compact('schedules', 'bookings'));
        }
    }
}
