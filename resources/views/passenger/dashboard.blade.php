@extends('layouts.dashboard')

@section('content')
    <h5>Dashboard Penumpang</h5>
    <h1>Selamat datang, {{ auth()->user()->name }}</h1>
    <hr>
    <div class="row">
        <div class="col-xl-8">
            <div class="shadow-sm card">
                <div class="card-body radius-15">
                    <h5><i class='bx bx-edit-alt' ></i> Profil Anda</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tr>
                                <td>
                                    <h6 class="text-muted"><i class='bx bx-user-circle'></i> Nama</h6>
                                </td>
                                <td>
                                    <h6 class="text-muted">:</h6>
                                </td>
                                <td>
                                    <h6 class="text-muted">{{ auth()->user()->name }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="text-muted"><i class='bx bx-envelope'></i> Email</h6>
                                </td>
                                <td>
                                    <h6 class="text-muted">:</h6>
                                </td>
                                <td>
                                    <h6 class="text-muted">{{ auth()->user()->email }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="text-muted"><i class='bx bx-map-alt'></i> Alamat</h6>
                                </td>
                                <td>
                                    <h6 class="text-muted">:</h6>
                                </td>
                                <td class="text-nowrap">
                                    <h6 class="text-muted">{{ auth()->user()->address ?? 'N/A' }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="text-muted"><i class='bx bx-phone'></i> No. Telepon</h6>
                                </td>
                                <td>
                                    <h6 class="text-muted">:</h6>
                                </td>
                                <td>
                                    <h6 class="text-muted">{{ auth()->user()->phone ?? 'N/A' }}</h6>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="shadow-sm card">
                <div class="card-body">
                    <h5><i class='bx bx-history'></i> Riwayat Pemesanan</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Maskapai</th>
                                    <th>Pesawat</th>
                                    <th>Kota Asal</th>
                                    <th>Kota Tujuan</th>
                                    <th>Waktu Berangkat</th>
                                    <th>Waktu Tiba</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->schedule->plane->airline->airline_name }}</td>
                                        <td>{{ $booking->schedule->plane->plane_name }}</td>
                                        <td>{{ $booking->schedule->departureCity->nama_kota }}</td>
                                        <td>{{ $booking->schedule->arrivalCity->nama_kota }}</td>
                                        <td>{{ $booking->schedule->departure_time }}</td>
                                        <td>{{ $booking->schedule->arrival_time }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <a href="{{ route('passenger.bookings') }}">
                <div class="card radius-10 bg-gradient-cosmic">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/icons/appointment-book.png" width="45" alt="" />
                            <div class="ms-auto text-end">
                                <button class="btn btn-light text-primary radius-10 fw-bold">Pesan Tiket</button>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-white">Anda dapat melakukan booking tiket pesawat disini</p>
                    </div>
                </div>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5><i class='bx bxs-plane-take-off'></i> Penerbangan hari ini</h5>
                    <hr>
                    <div class="row">
                        @forelse ($schedules as $schedule)
                            <div class="col-md-12">
                                <div class="shadow-sm bg-opacity-10 card bg-secondary radius-10"
                                    style="background-image: url({{ asset('assets/images/bg.jpg') }});background-size:cover;background-position:center;">
                                    <div class="card-body">
                                        <img src="{{ asset('storage/' . $schedule->plane->airline->logo) }}" alt="logo"
                                            class="mb-2 img-fluid" style="width: 50px">
                                        <h5 class="card-title fw-bold">{{ $schedule->plane->airline->airline_name }} -
                                            {{ $schedule->plane->plane_name }}</h5>
                                        <div class="fw-bold d-flex justify-content-between text-uppercase">
                                            <span class="fw-light" style="font-family: monospace">Code:
                                                {{ $schedule->plane->airline->airline_code }}</span>
                                            <span class="text-warning">{{ $schedule->departureCity->nama_kota }} -
                                                {{ $schedule->arrivalCity->nama_kota }}</span>
                                        </div>
                                        <hr>
                                        <div class="row justify-content-between">
                                            <div class="col-md-7 col-8">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="p-2 radius-10" style="border: 2px dashed #bdbdbd;">
                                                        <span
                                                            class="fw-bold">Departure</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                                                    <i class='bx bx-right-arrow-alt fs-1'></i>
                                                    <span class="p-2 radius-10" style="border: 2px dashed #ffc107;"><span
                                                            class="fw-bold">Arrival</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-4 d-flex justify-content-end align-items-center">
                                                <i class='bx bxs-plane fs-1'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="shadow-sm card bg-warning radius-10">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Tidak ada penerbangan hari ini</h5>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
