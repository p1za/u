<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Kota;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $airlines = Airline::with('planes')->get();
        $schedules = Schedule::all();
        $kotas = Kota::all();
        return view('admin.schedules.index', compact('airlines', 'schedules', 'kotas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'plane_id' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'departure_city_id' => 'required',
            'arrival_city_id' => 'required',
            'price' => 'required',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Berhasil menambahkan jadwal baru');
    }
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'plane_id' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'departure_city_id' => 'required',
            'arrival_city_id' => 'required',
            'price' => 'required',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Berhasil mengubah jadwal');
    }
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Berhasil menghapus jadwal');
    }
}
