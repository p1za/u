<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function index()
    {
        $kotas = Kota::paginate(10);
        return view('admin.kota.index', compact('kotas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:255',
            'kode_kota' => 'required|string|max:3',
        ]);

        Kota::create($request->all());

        return redirect()->back()->with('success', 'Kota berhasil ditambahkan.');
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:255',
            'kode_kota' => 'required|string|max:3',
        ]);

        $kota = Kota::find($id);
        $kota->update($request->all());

        return redirect()->back()->with('success', 'Kota berhasil diubah.');
    }
    public function destroy(string $id)
    {
        $kota = Kota::find($id);
        $kota->delete();
        return redirect()->back()->with('success', 'Kota berhasil dihapus.');
    }
}
