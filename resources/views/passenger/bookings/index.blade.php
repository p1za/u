@extends('layouts.dashboard')

@section('content')
    <h5>Daftar Tiket Penerbangan</h5>
    <hr>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5><i class='bx bx-filter-alt'></i> Filter Penerbangan</h5>
                <form action="{{ route('passenger.bookings') }}" method="GET">
                    <div class="row">
                        <div class="col-xl-4 col-12">
                            <div class="form-group
                                @error('from') has-error @enderror">
                                <label for="from">Kota Asal</label>
                                <select name="from" id="from" class="form-select">
                                    <option value="">Pilih Kota Asal</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request()->get('from') == $city->id ? 'selected' : '' }}>
                                            {{ $city->nama_kota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="form-group
                                @error('to') has-error @enderror">
                                <label for="to">Kota Tujuan</label>
                                <select name="to" id="to" class="form-select">
                                    <option value="">Pilih Kota Tujuan</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request()->get('to') == $city->id ? 'selected' : '' }}>
                                            {{ $city->nama_kota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="form-group
                                @error('date') has-error @enderror">
                                <label for="date">Tanggal Keberangkatan</label>
                                <input type="date" name="date" id="date" class="form-control"
                                    value="{{ request()->get('date') }}">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="mt-3 btn btn-primary">Cari Penerbangan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($schedules as $schedule)
            <div class="col-xl-4 col-md-6 col-12">
                <div class="border border-2 shadow-sm bg-opacity-10 card bg-secondary radius-15 border-warning"
                    style="background-image: url({{ asset('assets/images/bg.jpg') }});background-size:cover;background-position:center;">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $schedule->plane->airline->logo) }}" alt="logo"
                            class="mb-2 img-fluid" style="width: 50px">
                        <h5 class="card-title fw-bold">{{ $schedule->plane->airline->airline_name }} -
                            {{ $schedule->plane->plane_name }}</h5>
                        <div class="fw-bold d-flex justify-content-between text-uppercase">
                            <span class="fw-light" style="font-family: monospace">Code:
                                {{ $schedule->plane->airline->airline_code }}</span>
                            <h4 class="text-success fw-bold">{{ $schedule->departureCity->nama_kota }} -
                                {{ $schedule->arrivalCity->nama_kota }}</h4>
                        </div>
                        <p>
                            <img src="{{ asset('assets/images/seat-person.png') }}" alt="seat"
                                class="img-fluid" style="width: 20px">
                            <span class="fw-bold">{{ $schedule->plane->seats->count() }} Seat - Regular</span>
                        </p>
                        <hr>
                        <div class="row justify-content-between">
                            <div class="col-md-7 col-9">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="p-2 radius-10" style="border: 2px dashed #bdbdbd;"><span
                                            class="fw-bold">Departure</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                                    <i class='bx bxs-plane fs-1' style="transform: rotate(90deg);"></i>
                                    <span class="p-2 radius-10" style="border: 2px dashed #ffc107;"><span
                                            class="fw-bold">Arrival</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="mt-3 col-md-3 col-12 mt-sm-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Time
                                        <br>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('passenger.bookings.detail', $schedule->id) }}"
                                class="mt-4 btn btn-danger rounded-pill"><i class='bx bx-paper-plane'></i> Pesan
                                Sekarang</a>
                            <span class="fw-bold fs-3">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-xl-12">
                <div class="alert alert-danger" role="alert">
                    <i class='bx bx-error-circle'></i> Tidak ada jadwal penerbangan yang tersedia
                </div>
            </div>
        @endforelse
    </div>
    <div class="mt-3">
        {{ $schedules->links() }}
    </div>
@endsection
