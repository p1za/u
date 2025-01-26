@extends('layouts.dashboard')

@section('content')
    <h3><i class='bx bx-receipt'></i> Data Pemesanan</h3>
    <x-notify />
    <div class="row">
        <div class="col-xl-12">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="mt-3 table-responsive">
                        <table class="table align-middle table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No. Booking</th>
                                    <th>Nama Penumpang</th>
                                    <th>Maskapai</th>
                                    <th>Nomor Kursi</th>
                                    <th>Tanggal Berangkat</th>
                                    <th>Harga</th>
                                    <th>Status Pembayaran</th>
                                    <th>Bukti Transfer</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td><span class="badge bg-danger rounded-pill">{{ $booking->booking_code }}</span>
                                        </td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>
                                            <div class="gap-3 d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $booking->seat->plane->airline->logo) }}"
                                                    alt="logo" class="img-fluid" style="max-width: 50px">
                                                <div class="d-flex flex-column">
                                                    <span
                                                        class="fw-bold">{{ $booking->seat->plane->airline->airline_name }}</span>
                                                    <span>{{ $booking->schedule->departureCity->kode_kota }} -
                                                        {{ $booking->schedule->arrivalCity->kode_kota }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info fs-6 rounded-pill">{{ $booking->seat->seat_number }}</span></td>
                                        <td>{{ $booking->schedule->departure_time }}</td>
                                        <td>Rp {{ number_format($booking->schedule->price, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($booking->status == 'diproses')
                                                <span
                                                    class="border border-2 border-secondary badge bg-warning text-dark fs-6 radius-10 text-warning"><i
                                                        class='bx bx-time'></i> Diproses</span>
                                            @elseif ($booking->status == 'setuju')
                                                <span
                                                    class="bg-white border border-2 badge border-success fs-6 radius-10 text-success fw-light"><i
                                                        class='bx bx-check-circle'></i> Sukses</span>
                                            @else
                                                <span
                                                    class="bg-white border border-2 badge border-danger fs-6 radius-10 text-danger fw-light"><i
                                                        class='bx bx-x-circle'></i> Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary rounded-pill btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#buktiTransfer{{ $booking->id }}">
                                                <i class='bx bx-paperclip'></i> Lihat Bukti</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="buktiTransfer{{ $booking->id }}" tabindex="-1"
                                                aria-labelledby="buktiTransfer{{ $booking->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="buktiTransfer{{ $booking->id }}Label">Bukti
                                                                Transfer - {{ $booking->booking_code }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Metode pembayaran</p>
                                                            <div
                                                                class="border border-2 shadow-sm border-secondary card payment-card radius-10">
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="{{ asset('storage/' . $booking->payment->logo) }}"
                                                                            width="45" alt="" />
                                                                        <div class="d-flex flex-column ms-3">
                                                                            <span
                                                                                class="fw-bold">{{ $booking->payment->payment_name }}</span>
                                                                            <small>A/N.{{ $booking->payment->payment_to }}
                                                                                <br>{{ $booking->payment->payment_number }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3 alert alert-info" role="alert">
                                                                <i class='bx bx-info-circle'></i> Mohon verifikasi
                                                                pembayaran <b>sebelum merubah status pemesanan</b>
                                                            </div>
                                                            <img src="{{ asset('storage/' . $booking->payment_proof) }}"
                                                                alt="bukti transfer" class="img-fluid">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST"
                                                id="status-form-{{ $booking->id }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" id="status" class="form-select"
                                                    onchange="document.getElementById('status-form-{{ $booking->id }}').submit();">
                                                    <option value="diproses"
                                                        {{ $booking->status == 'diproses' ? 'selected' : '' }}>
                                                        Diproses</option>
                                                    <option value="setuju"
                                                        {{ $booking->status == 'setuju' ? 'selected' : '' }}>
                                                        Sukses</option>
                                                    <option value="dibatalkan"
                                                        {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}>
                                                        Dibatalkan
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
