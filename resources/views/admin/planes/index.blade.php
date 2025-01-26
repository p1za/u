@extends('layouts.dashboard')

@section('content')
    <h3><i class='bx bxs-plane-land' ></i> Master Unit Pesawat</h3>
    <x-notify />
    <div class="row">
        <div class="col-xl-4">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <h1 class="mb-0 border border-2 badge bg-dark text-warning border-warning fs-5 radius-10">Tambah Unit Pesawat</h1>
                    </div>
                    <form action="{{ route('unit.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Pilih Maskapai</label>
                            <select class="form-select" id="airline_id" name="airline_id" required>
                                <option value="">Pilih Maskapai</option>
                                @forelse ($airlines as $airline)
                                    <option value="{{ $airline->id }}">{{ $airline->airline_name }}</option>
                                @empty
                                    <option value="">Data Maskapai Kosong</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Nama Pesawat</label>
                            <input type="text" class="form-control" id="plane_name" name="plane_name"
                                placeholder="Boeing 777" required>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success rounded-pill">Tambah Unit Pesawat</button>
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
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Maskapai</th>
                                    <th scope="col">Nama Pesawat</th>
                                    <th scope="col">Total Kursi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($planes as $plane)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="gap-3 d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $plane->airline->logo) }}" alt="logo"
                                                    class="img-fluid" style="max-width: 50px">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold">{{ $plane->airline->airline_name }}</span>
                                                    <span>{{ $plane->airline->airline_code }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $plane->plane_name }}</td>
                                        <td>{{ $plane->seats->count() }} Kursi</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm rounded-pill"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $plane->id }}"><i
                                                    class="bx bx-edit"></i> Edit</button>
                                            <div class="shadow modal fade" id="edit{{ $plane->id }}" tabindex="-1"
                                                aria-labelledby="edit{{ $plane->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="edit{{ $plane->id }}Label">Edit
                                                                Unit
                                                                Pesawat</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('unit.update', $plane->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Pilih
                                                                        Maskapai</label>
                                                                    <select class="form-select" id="airline_id"
                                                                        name="airline_id" required>
                                                                        <option value="">Pilih Maskapai</option>
                                                                        @forelse ($airlines as $airline)
                                                                            <option value="{{ $airline->id }}"
                                                                                {{ $plane->airline_id == $airline->id ? 'selected' : '' }}>
                                                                                {{ $airline->airline_name }}</option>
                                                                        @empty
                                                                            <option value="">Data Maskapai Kosong
                                                                            </option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="code" class="form-label">Nama
                                                                        Pesawat</label>
                                                                    <input type="text" class="form-control"
                                                                        id="plane_name" name="plane_name"
                                                                        value="{{ $plane->plane_name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('unit.destroy', $plane->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill"
                                                    onclick="return confirm('Anda yakin ingin menghapus unit pesawat ini?')"><i
                                                        class="bx bx-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data Unit Pesawat Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $planes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
