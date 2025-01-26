<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image',
            'payment_name' => 'required|string',
            'payment_to' => 'required|string',
            'payment_number' => 'required|string',
            'status' => 'required|boolean',
        ]);

        try {
            $logo = $request->file('logo')->store('logo_pembayaran', 'public');

            $payment = new Payment();
            $payment->logo = $logo;
            $payment->payment_name = $request->payment_name;
            $payment->payment_to = $request->payment_to;
            $payment->payment_number = $request->payment_number;
            $payment->status = $request->status;
            $payment->save();

            return redirect()->back()->with('success', 'Berhasil menambahkan metode pembayaran.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan metode pembayaran.');
        }
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => 'nullable|image',
            'payment_name' => 'required|string',
            'payment_to' => 'required|string',
            'payment_number' => 'required|string',
            'status' => 'required|boolean',
        ]);

        try {
            $payment = Payment::findOrFail($id);

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo')->store('logo_pembayaran', 'public');
                $payment->logo = $logo;
            }

            $payment->payment_name = $request->payment_name;
            $payment->payment_to = $request->payment_to;
            $payment->payment_number = $request->payment_number;
            $payment->status = $request->status;
            $payment->save();

            return redirect()->back()->with('success', 'Berhasil mengubah metode pembayaran.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah metode pembayaran.');
        }
    }
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus metode pembayaran.');
    }
}
