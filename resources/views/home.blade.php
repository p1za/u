@extends('layouts.landing')

@section('content')
    <section class="px-3 bsb-hero-1 bsb-overlay bsb-hover-pull vh-100 position-relative"
        style="background-image: url('{{ asset('assets/images/hero.jpeg') }}');background-size: cover; background-position: center;">
        <div class="overlay-dark position-absolute w-100 h-100"
            style="background-color: rgba(0, 0, 0, 0.7); top: 0; left: 0;"></div>
        <div class="container position-relative d-flex justify-content-center align-items-center vh-100">
            <div class="text-center text-white col-12 col-xl-8">
                <h2 class="mb-3 text-white display-3 fw-bold">Welcome to E-Ticketing</h2>
                <p class="mb-5 lead">Temukan tiket pesawat dengan harga terbaik dan jadwal yang sesuai dengan kebutuhan
                    Anda.</p>
                <div class="gap-2 d-grid d-sm-flex justify-content-sm-center">
                    <a href="#booking" class="gap-3 btn btn-light btn-lg rounded-pill">Booking sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5" id="booking"
        style="background-image: url('{{ asset('assets/images/main-background.png') }}');background-size: cover;background-position: center;background-repeat: no-repeat;">
        <div class="container">
            <div class="pt-5 row">
                <div class="py-3 shadow-md card radius-10">
                    <div class="card-body">
                        <div class="mb-4 col-12 col-lg-6">
                            <h2 class="fw-bold"><i class='bx bxs-plane-take-off'></i> Cari tiket yang tersedia</h2>
                            <p class="lead">Temukan tiket untuk tujuan Anda pada jadwal yang tersedia.</p>
                        </div>
                        <hr>
                        <form action="{{ route('home') }}" method="GET">
                            <div class="row">
                                <div class="col-xl-3">
                                    <label for="inputGroupSelect01" class="form-label">Cari Kota Asal</label>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                class='bx bxs-map'></i></span>
                                        <select class="form-select" name="from" id="inputGroupSelect01"
                                            aria-label="Default select example">
                                            <option value="" disabled selected>Pilih Kota Asal</option>
                                            @foreach ($kotas as $kota)
                                                <option value="{{ $kota->id }}">{{ $kota->nama_kota }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <label for="inputGroupSelect01" class="form-label">Cari Kota Tujuan</label>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                class='bx bxs-map'></i></span>
                                        <select class="form-select" name="to" id="inputGroupSelect01">
                                            <option value="" disabled selected>Pilih Kota Tujuan</option>
                                            @foreach ($kotas as $kota)
                                                <option value="{{ $kota->id }}">{{ $kota->nama_kota }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <label for="inputGroupSelect01" class="form-label">Tanggal Pergi</label>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                class="bx bx-calendar"></i></span>
                                        <input type="date" class="m-0 form-control" name="departure_time"
                                            placeholder="Cari tiket" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <label for="inputGroupSelect01" class="form-label">Tanggal Kembali</label>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                class="bx bx-calendar"></i></span>
                                        <input type="date" class="m-0 form-control" name="arrival_time"
                                            placeholder="Cari tiket" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded-pill"><i class='bx bx-search'></i>
                                        Cari Penerbangan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-5 row justify-content-center">
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
                                    <h4 class="mt-3 text-success fw-bold">{{ $schedule->departureCity->nama_kota }} -
                                        {{ $schedule->arrivalCity->nama_kota }}</h4>
                                </div>
                                <p>
                                    <img src="{{ asset('assets/images/seat-person.png') }}" alt="seat"
                                        class="img-fluid" style="width: 20px">
                                    <span class="fw-bold">{{ $schedule->plane->seats->count() }} Seat - Regular</span>
                                </p>
                                <hr>
                                <div class="row justify-content-between">
                                    <div class="col-md-8 col-9">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="p-2 radius-10" style="border: 2px dashed #bdbdbd;"><span
                                                    class="fw-bold">Departure</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                                            <i class='bx bxs-plane fs-4' style="transform: rotate(90deg);"></i>
                                            <span class="p-2 radius-10" style="border: 2px dashed #ffc107;"><span
                                                    class="fw-bold">Arrival</span><br />{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-3 col-md-4 col-12 mt-sm-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-nowrap"><b>Boarding</b>
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
                    {{-- <div class="alert --}}
                @endforelse
            </div>
        </div>
    </section>
@endsection
