<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::query();

        if ($request->filled('from')) {
            $query->where('departure_city_id', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->where('arrival_city_id', $request->input('to'));
        }

        if ($request->filled('departure_time')) {
            $query->whereDate('departure_time', '=', date('Y-m-d', strtotime($request->input('departure_time'))));
        }

        if ($request->filled('arrival_time')) {
            $query->whereDate('arrival_time', '=', date('Y-m-d', strtotime($request->input('arrival_time'))));
        }

        $schedules = $query->paginate(3);
        $kotas = Kota::all();

        return view('home', compact('schedules', 'kotas'));
    }
}
