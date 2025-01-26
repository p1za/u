<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    public function index()
    {
        $planes = Plane::paginate(10);
        $airlines = Airline::all();
        return view('admin.planes.index', compact('planes', 'airlines'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'airline_id' => 'required',
            'plane_name' => 'required',
        ]);

        Plane::create($request->all());
        return redirect()->back()->with('success', 'Unit pesawat berhasil ditambahkan.');
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'airline_id' => 'required',
            'plane_name' => 'required',
        ]);

        $plane = Plane::find($id);
        $plane->update($request->all());
        return redirect()->back()->with('success', 'Unit pesawat berhasil diubah.');
    }
    public function destroy(string $id)
    {
        $plane = Plane::find($id);
        $plane->delete();
        return redirect()->back()->with('success', 'Unit pesawat berhasil dihapus.');
    }
}
