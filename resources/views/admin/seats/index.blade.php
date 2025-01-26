@extends('layouts.dashboard')

@section('content')
    <h3><i class='bx bx-bookmarks'></i> Master Kursi Pesawat</h3>
    <x-notify />
    <div class="row">
        <div class="col-xl-4">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0 border border-2 badge text-warning bg-dark border-warning fs-5 radius-10">Tambah Kursi Pesawat</h1>
                    </div>
                    <form action="{{ route('seats.store') }}" method="POST">
                        @csrf
                        <div class="mt-3 row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="plane_id" class="form-label">Unit Pesawat</label>
                                    <select class="form-select" name="plane_id" id="maskapai" required>
                                        <option value="" selected disabled>Pilih Maskapai</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->plane_name }} -
                                                {{ $unit->airline->airline_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="total_seat" class="form-label">Total Kursi</label>
                                    <input type="number" class="form-control" name="total_seat" id="total_seat"
                                        placeholder="5">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success rounded-pill">Tambah Seat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="mt-3 table-responsive">
                        <table class="table align-middle table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Maskapai</th>
                                    <th>Nomor Kursi</th>
                                    <th>Unit Pesawat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seats as $seat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="gap-3 d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $seat->plane->airline->logo) }}"
                                                    alt="logo" class="img-fluid" style="max-width: 50px">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold">{{ $seat->plane->airline->airline_name }}</span>
                                                    <span>{{ $seat->plane->airline->airline_code }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info rounded-pill fs-6">{{ $seat->seat_number }}</span>
                                        </td>
                                        <td><span class="badge bg-success rounded-pill fs-6"> <i
                                                    class='bx bxs-plane-alt'></i>{{ $seat->plane->plane_name }}</span></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm rounded-pill d-inline" data-bs-toggle="modal"
                                                data-bs-target="#editSeat{{ $seat->id }}"><i class="bx bx-edit"></i>Edit</button>
                                            <div class="modal fade" id="editSeat{{ $seat->id }}" tabindex="-1"
                                                aria-labelledby="editSeat{{ $seat->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editSeat{{ $seat->id }}Label">Edit
                                                                Kursi Pesawat</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('seats.update', $seat->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="plane_id" class="form-label">Unit Pesawat</label>
                                                                    <select class="form-select" name="plane_id" id="maskapai"
                                                                        required>
                                                                        <option value="" selected disabled>Pilih Maskapai</option>
                                                                        @foreach ($units as $unit)
                                                                            <option value="{{ $unit->id }}"
                                                                                {{ $unit->id == $seat->plane_id ? 'selected' : '' }}>
                                                                                {{ $unit->plane_name }} -
                                                                                {{ $unit->airline->airline_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="seat_number" class="form-label">Nomor Kursi</label>
                                                                    <input type="text" class="form-control" name="seat_number"
                                                                        id="seat_number" value="{{ $seat->seat_number }}"
                                                                        placeholder="1A">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('seats.destroy', $seat->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill"><i
                                                        class="bx bx-trash"></i>Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $seats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
