<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index()
    {
        $airlines = Airline::paginate(perPage: 10);
        return view('admin.airlines.index', compact('airlines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'airline_name' => 'required',
            'airline_code' => 'required',
            'country' => 'required',
            'logo' => 'required|image',
        ]);

        try {
            $logo = $request->file('logo')->store('logos', 'public');

            $airline = new Airline();
            $airline->airline_name = $request->airline_name;
            $airline->airline_code = $request->airline_code;
            $airline->country = $request->country;
            $airline->logo = $logo;
            $airline->save();

            return redirect()->back()->with('success', 'Berhasil menambahkan maskapai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan maskapai.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'airline_name' => 'required',
            'airline_code' => 'required',
            'country' => 'required',
            'status' => 'required',
            'logo' => 'image',
        ]);

        try {
            $airline = Airline::find($id);
            $airline->airline_name = $request->airline_name;
            $airline->airline_code = $request->airline_code;
            $airline->country = $request->country;
            $airline->status = $request->status;

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo')->store('logos', 'public');
                $airline->logo = $logo;
            }

            $airline->save();

            return redirect()->back()->with('success', 'Berhasil mengupdate maskapai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate maskapai.');
        }
    }

    public function destroy($id)
    {
        try {
            $airline = Airline::find($id);
            $airline->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus maskapai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus maskapai.');
        }
    }
}
