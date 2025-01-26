<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::orderBy('created_at', 'desc')->paginate(10);
        $units = Plane::all();
        return view('admin.seats.index', compact('seats', 'units'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'total_seat' => 'required|integer|min:1',
        ]);

        $plane = Plane::find($request->plane_id);
        $totalSeat = $request->total_seat;

        $seats = [];
        $i = 1;
        while (count($seats) < $totalSeat) {
            $row = ceil($i / 3);
            $seatNumber = $row . chr(64 + ($i % 3 == 0 ? 3 : $i % 3));
            if (!Seat::where('plane_id', $plane->id)->where('seat_number', $seatNumber)->exists()) {
                $seats[] = [
                    'plane_id' => $plane->id,
                    'seat_number' => $seatNumber,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $i++;
        }

        Seat::insert($seats);

        return redirect()->back()->with('success', 'Berhasil menambahkan kursi');
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'seat_number' => 'required',
        ]);
        $seat = Seat::find($id);
        $seat->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah kursi');
    }
    public function destroy(string $id)
    {
        $seat = Seat::find($id);
        $seat->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus kursi');
    }
}
