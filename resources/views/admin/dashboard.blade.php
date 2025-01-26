@extends('layouts.dashboard')

@section('content')
    <h5>Dashboard Admin</h5>
    <h1>Selamat datang, {{ auth()->user()->name }}</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Jadwal</p>
                            <h4 class="my-3 fw-bold">{{ $scheduleCount }} Jadwal</h4>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto">
                            <i class="bx bx-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Customers</p>
                            <h4 class="my-3 fw-bold">{{ $passengerCount }} Pengguna</h4>
                        </div>
                        <div class="widgets-icons bg-light-info text-info ms-auto">
                            <i class="bx bxs-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Maskapai</p>
                            <h4 class="my-3 fw-bold">{{ $airlines->count() }} Maskapai</h4>
                        </div>
                        <div class="widgets-icons bg-light-primary text-primary ms-auto">
                            <i class="bx bxs-plane"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Bookings</p>
                            <h4 class="my-3 fw-bold">{{ $bookingCount }} Pemesan</h4>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto">
                            <i class="bx bx-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card radius-10">
            <div class="card-body">
                <h5>Ringkasan Penjualan Tiket</h5>
                <div class="row">
                    @forelse($airlines as $airline)
                        <div style="cursor: pointer;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <img src="{{ asset("storage/{$airline->logo}") }}" width="45" alt="" />
                                        <div class="flex-wrap d-flex flex-column ms-3">
                                            <span class="fw-bold">{{ $airline->airline_name }}</span>
                                            <span class="text-secondary">{{ $airline->airline_code }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $approvedCount = \App\Models\Booking::whereIn(
                                            'seat_id',
                                            \App\Models\Seat::whereIn(
                                                'plane_id',
                                                \App\Models\Plane::where('airline_id', $airline->id)->pluck('id'),
                                            )->pluck('id'),
                                        )
                                            ->where('status', 'setuju')
                                            ->count();
                                        $canceledCount = \App\Models\Booking::whereIn(
                                            'seat_id',
                                            \App\Models\Seat::whereIn(
                                                'plane_id',
                                                \App\Models\Plane::where('airline_id', $airline->id)->pluck('id'),
                                            )->pluck('id'),
                                        )
                                            ->where('status', 'dibatalkan')
                                            ->count();
                                    @endphp

                                    @if ($approvedCount > 0 || $canceledCount > 0)
                                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                                            @if ($approvedCount > 0)
                                                <span
                                                    class="border text-success badge border-1 border-success rounded-pill me-2"
                                                    style="font-size: 15px">
                                                    <i class='bx bx-check-circle'></i> {{ $approvedCount }} Tiket terjual
                                                </span>
                                            @endif
                                            @if ($canceledCount > 0)
                                                <span class="border text-danger badge border-1 border-danger rounded-pill"
                                                    style="font-size: 15px">
                                                    <i class='bx bx-x-circle'></i> {{ $canceledCount }} Tiket dibatalkan
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                                            <span class="border text-warning badge border-1 border-warning rounded-pill"
                                                style="font-size: 15px">
                                                <i class='bx bx-info-circle' ></i> Belum ada tiket terjual
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">
                                Belum ada maskapai yang terdaftar
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
