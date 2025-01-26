<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kota;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('seat')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }
    public function update(Request $request, string $id)
    {
        $booking = Booking::find($id);
        $booking->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah status booking');
    }
    public function showFormBooking(Request $request)
    {
        $query = Schedule::query();

        if ($request->filled('from')) {
            $query->where('departure_city_id', $request->input('from'));
        }
        if ($request->filled('to')) {
            $query->where('arrival_city_id', $request->input('to'));
        }
        if ($request->filled('date')) {
            $query->whereDate('departure_time', '=', date('Y-m-d', strtotime($request->input('date'))));
        }

        $schedules = $query->paginate(10);
        $cities = Kota::all();

        return view('passenger.bookings.index', compact('schedules', 'cities'));
    }

    public function showDetailBooking(string $id)
    {
        $schedule = Schedule::with('plane.seats')->find($id);
        $seats = $schedule->plane->seats->filter(function ($seat) use ($schedule) {
            $booking = Booking::where('seat_id', $seat->id)
                ->where('schedule_id', $schedule->id)
                ->where('status', '!=', 'dibatalkan')
                ->first();
            return !$booking;
        });
        $payments = Payment::all();
        return view('passenger.bookings.detail', compact('schedule', 'seats', 'payments'));
    }

    public function storeBooking(Request $request, string $id)
    {
        $request->validate([
            'seats' => 'required|array',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user_id = auth()->user()->id;

        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        foreach ($request->seats as $seat) {
            $lastBooking = Booking::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();
            $lastNumber = $lastBooking ? (int) substr($lastBooking->booking_code, -2) : 0;
            $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
            $booking_code = 'BK-' . date('dmY') . strtoupper(\Str::random(3)) . $newNumber;

            Booking::create([
                'booking_code' => $booking_code,
                'schedule_id' => $id,
                'seat_id' => (int) $seat,
                'user_id' => $user_id,
                'payment_id' => $request->payment_id,
                'payment_proof' => $paymentProofPath ?? null,
                'status' => 'diproses',
            ]);
        }
        return redirect()->back()->with('success', 'Berhasil melakukan booking');
    }

    public function showMyBooking()
    {
        $user_id = auth()->user()->id;
        $bookings = Booking::where('user_id', $user_id)->paginate(10);
        return view('passenger.bookings.my-booking', compact('bookings'));
    }

    public function cancelBooking(string $id)
    {
        $booking = Booking::find($id);
        $booking->update(['status' => 'dibatalkan']);
        return redirect()->back()->with('success', 'Berhasil membatalkan booking');
    }
}
