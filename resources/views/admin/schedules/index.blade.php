@extends('layouts.dashboard')

@section('content')
    <h3><i class='bx bx-calendar' ></i> Master Jadwal</h3>
    <x-notify />
    <div class="row">
        <div class="col-xl-12">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0 border border-2 badge bg-dark text-warning border-warning fs-5 radius-10">Buat Jadwal Baru</h1>
                    </div>
                    <form action="{{ route('schedules.store') }}" method="POST">
                        @csrf
                        <div class="mt-3 row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="plane_id" class="form-label">Maskapai</label>
                                    <select class="form-select" name="plane_id" id="maskapai">
                                        <option selected disabled>Pilih Maskapai</option>
                                        @foreach ($airlines as $airline)
                                            @foreach ($airline->planes as $plane)
                                                <option value="{{ $plane->id }}">
                                                    {{ $airline->airline_name }} - {{ $plane->plane_name }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="rute" class="form-label">Asal</label>
                                            <select class="form-select" name="departure_city_id" id="departure_city_id">
                                                <option value="" selected disabled>Pilih Kota Asal</option>
                                                @foreach ($kotas as $kota)
                                                    <option value="{{ $kota->id }}">
                                                        {{ $kota->nama_kota }} - {{ $kota->kode_kota }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="rute" class="form-label">Tujuan</label>
                                            <select class="form-select" name="arrival_city_id" id="arrival_city_id">
                                                <option value="" selected disabled>Pilih Kota Tujuan</option>
                                                @foreach ($kotas as $kota)
                                                    <option value="{{ $kota->id }}">
                                                        {{ $kota->nama_kota }} - {{ $kota->kode_kota }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="departure" class="form-label">Departure Date</label>
                                    <input type="datetime-local" class="form-control" name="departure_time"
                                        id="departure_time">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="arrival" class="form-label">Arrival</label>
                                    <input type="datetime-local" class="form-control" name="arrival_time" id="arrival_time">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        placeholder="100000">
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <p class="text-danger">
                                    *Perhatikan waktu yang anda masukkan
                                </p> --}}
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="mt-3 table-responsive">
                        <table class="table align-middle table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Maskapai</th>
                                    <th>Rute</th>
                                    <th>Departure Date</th>
                                    <th>Arrival Date</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->plane->airline->airline_name }} -
                                            {{ $schedule->plane->plane_name }}</td>
                                        <td>{{ $schedule->departureCity->nama_kota }} - {{ $schedule->arrivalCity->nama_kota }}
                                        <td>{{ $schedule->departure_time }}</td>
                                        <td>{{ $schedule->arrival_time }}</td>
                                        <td>Rp {{ number_format($schedule->price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="gap-2 d-flex">
                                                <button class="btn btn-warning rounded-pill btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $schedule->id }}"><i class="bx bx-edit"></i>
                                                    Edit</button>
                                                <form action="{{ route('schedules.destroy', $schedule->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger rounded-pill btn-sm"><i
                                                            class="bx bx-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                            <div class="modal fade text-start" id="edit{{ $schedule->id }}" tabindex="-1"
                                                aria-labelledby="edit{{ $schedule->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="edit{{ $schedule->id }}Label">Edit
                                                                Schedule</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('schedules.update', $schedule->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="plane_id"
                                                                        class="form-label">Maskapai</label>
                                                                    <select class="form-select" name="plane_id"
                                                                        id="maskapai">
                                                                        <option selected disabled>Pilih Maskapai</option>
                                                                        @foreach ($airlines as $airline)
                                                                            @foreach ($airline->planes as $plane)
                                                                                <option value="{{ $plane->id }}"
                                                                                    {{ $plane->id == $schedule->plane_id ? 'selected' : '' }}>
                                                                                    {{ $airline->airline_name }} -
                                                                                    {{ $plane->plane_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="rute" class="form-label">Asal</label>
                                                                            <select class="form-select" name="departure_city_id"
                                                                                id="departure_city_id">
                                                                                <option value="" selected disabled>Pilih Kota
                                                                                    Asal</option>
                                                                                @foreach ($kotas as $kota)
                                                                                    <option value="{{ $kota->id }}"
                                                                                        {{ $kota->id == $schedule->departure_city_id ? 'selected' : '' }}>
                                                                                        {{ $kota->nama_kota }} - {{ $kota->kode_kota }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="rute" class="form-label">Tujuan</label>
                                                                            <select class="form-select" name="arrival_city_id"
                                                                                id="arrival_city_id">
                                                                                <option value="" selected disabled>Pilih Kota
                                                                                    Tujuan</option>
                                                                                @foreach ($kotas as $kota)
                                                                                    <option value="{{ $kota->id }}"
                                                                                        {{ $kota->id == $schedule->arrival_city_id ? 'selected' : '' }}>
                                                                                        {{ $kota->nama_kota }} - {{ $kota->kode_kota }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="departure" class="form-label">Departure
                                                                        Date</label>
                                                                    <input type="datetime-local" class="form-control"
                                                                        name="departure_time" id="departure_time"
                                                                        value="{{ date('Y-m-d\TH:i', strtotime($schedule->departure_time)) }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="arrival"
                                                                        class="form-label">Arrival</label>
                                                                    <input type="datetime-local" class="form-control"
                                                                        name="arrival_time" id="arrival_time"
                                                                        value="{{ date('Y-m-d\TH:i', strtotime($schedule->arrival_time)) }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="price" class="form-label">Price</label>
                                                                    <input type="number" class="form-control"
                                                                        name="price" id="price"
                                                                        placeholder="100000"
                                                                        value="{{ $schedule->price }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
