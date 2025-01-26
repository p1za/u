@extends('layouts.dashboard')

@section('content')
    <style>
        .form-check-input:checked+.btn-seat {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
            cursor: pointer;
        }

        .form-check-input:checked+.btn-seat .seat-image {
            filter: brightness(0) invert(1);
            cursor: pointer;
        }

        .btn-outline-success:hover .seat-image {
            filter: brightness(0) invert(1);
            cursor: pointer;
        }
    </style>
    <h5>Detail Pemesanan Tiket Penerbangan</h5>
    <hr>
    <x-notify />
    <div class="row">
        <div class="col-xl-5 col-md-6 col-12">
            <div class="shadow-md card radius-15" style="border: 2px dashed #0d6efd;">
                <div class="card-body">
                    <h6>Informasi Penerbangan</h6>
                    <img src="{{ asset('storage/' . $schedule->plane->airline->logo) }}" alt="logo" class="mb-2 img-fluid"
                        style="width: 50px">
                    <h5 class="card-title fw-bold">{{ $schedule->plane->airline->airline_name }} -
                        {{ $schedule->plane->plane_name }}</h5>
                    <div class="fw-bold d-flex justify-content-between text-uppercase">
                        <span class="fw-light" style="font-family: monospace">Code:
                            {{ $schedule->plane->airline->airline_code }}</span>
                        <h4 class="mt-3 text-danger fw-bold">{{ $schedule->departureCity->nama_kota }} -
                            {{ $schedule->arrivalCity->nama_kota }}</h4>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                        <div class="col-md-7 col-9">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="p-2 bg-white radius-10" style="border: 2px dashed #bdbdbd;"><span
                                        class="fw-bold">Departure</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                                <i class='bx bxs-plane fs-1' style="transform: rotate(90deg);"></i>
                                <span class="p-2 bg-white radius-10" style="border: 2px dashed #ffc107;"><span
                                        class="fw-bold">Arrival</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="mt-3 col-md-3 col-12 mt-sm-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><span class="fw-bold">Boarding</span>
                                    <br>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-md-6 col-12">
            <div class="shadow-md card radius-15">
                <div class="card-body">
                    <h6 class="mb-3 border border-2 badge bg-dark text-warning border-warning fs-6 radius-10">Konfirmasi
                        pemesanan</h6>
                    <form action="{{ route('passenger.bookings.store', $schedule->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="payment_id" id="payment_id">
                        <div class="mb-3 form-group">
                            <label for="passenger_name">Nama Pemesan</label>
                            <input type="text" class="form-control form-control-sm" name="passenger_name"
                                id="passenger_name" placeholder="Nama Penumpang" required
                                value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="passenger_email">Email Pemesan</label>
                            <input type="email" class="form-control form-control-sm" name="passenger_email"
                                id="passenger_email" placeholder="Email Penumpang" required
                                value="{{ auth()->user()->email }}" disabled>
                        </div>
                        <h6 class="m-0">Pilih Kursi</h6>
                        <div class="form-group">
                            <p><small>*Anda dapat memilih lebih dari satu kursi dalam sekali pemesanan</small></p>
                            <div class="row">
                                @foreach ($seats as $seat)
                                    <div class="col-xl-4 col-4">
                                        <div class="p-0 mb-3 form-check">
                                            <input class="form-check-input d-none" type="checkbox" name="seats[]"
                                                value="{{ $seat->id }}" id="seat-{{ $seat->seat_number }}">
                                            <label class="btn w-100 fw-bold btn-seat" style="border: 2px solid #0d6efd;"
                                                for="seat-{{ $seat->seat_number }}">
                                                <img src="{{ asset('assets/images/seat-person.png') }}" width="20"
                                                    alt="" class="seat-image">{{ $seat->seat_number }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="alert alert-warning" role="alert">
                                <i class='bx bx-error-circle'></i> Anda hanya dapat memilih kursi yang tersedia
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="payment_id">Metode pembayaran</label>
                            <div class="row">
                                @forelse ($payments as $payment)
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="shadow-sm card payment-card radius-10"
                                            id="payment-card-{{ $payment->id }}" data-payment-id="{{ $payment->id }}" style="cursor: pointer;">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $payment->logo) }}" width="45"
                                                        alt="" />
                                                    <div class="d-flex flex-column ms-3">
                                                        <span class="fw-bold">{{ $payment->payment_name }}</span>
                                                        <small>A/N.{{ $payment->payment_to }}
                                                            <br>{{ $payment->payment_number }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.getElementById('payment-card-{{ $payment->id }}').addEventListener('click', function() {
                                                document.querySelectorAll('.payment-card').forEach(function(card) {
                                                    card.style.border = 'none';
                                                });
                                                this.style.border = '1px solid #0d6efd';
                                                document.getElementById('payment_id').value = this.getAttribute('data-payment-id');
                                            });
                                        </script>
                                    </div>
                                @empty
                                    <div class="col-xl-12">
                                        <div class="alert alert-warning" role="alert">
                                            <i class='bx bx-error-circle'></i> Metode pembayaran tidak tersedia
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="payment_proof">Upload Bukti Pembayaran</label>
                            <p class="m-0">
                                <small><i>*File harus berformat JPG, JPEG, PNG (maksimal: 2mb)</i></small>
                            </p>
                            <input type="file" class="form-control form-control-sm" name="payment_proof"
                                id="payment_proof" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#confirmModal">Pesan
                                Sekarang</button>
                        </div>
                        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pemesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin memesan tiket penerbangan ini, anda tidak dapat mengubah
                                            data setelah simpan?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success btn-sm">Ya, Pesan Sekarang</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
