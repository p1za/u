@extends('layouts.dashboard')

@section('content')
    <h3><i class='bx bxs-plane-alt'></i> Master Maskapai</h3>
    <x-notify />
    <div class="row">
        <div class="col-xl-4">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="flex-wrap gap-3 mb-3 d-flex align-items-center justify-content-between">
                        <h1 class="mb-0 border border-2 badge bg-dark text-warning border-warning fs-5 radius-10">Tambah Maskapai</h1>
                    </div>
                    <form action="{{ route('airlines.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Maskapai</label>
                            <input type="text" class="form-control" id="name" name="airline_name"
                                placeholder="Garuda Indonesia">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Kode Maskapai </label>
                            <input type="text" class="form-control" id="code" name="airline_code" placeholder="GA">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Country</label>
                            <input type="text" class="form-control" id="code" name="country"
                                placeholder="Indonesia">
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Maskapai</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success rounded-pill">Tambah Maskapai</button>
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
                                    <th scope="col">Logo</th>
                                    <th scope="col">Nama Maskapai</th>
                                    <th scope="col">Kode Maskapai</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Total Unit Pesawat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($airlines as $airline)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $airline->logo) }}" alt="logo"
                                                class="img-fluid" style="width: 50px">
                                        </td>
                                        <td>{{ $airline->airline_name }}</td>
                                        <td>{{ $airline->airline_code }}</td>
                                        <td>{{ $airline->country }}</td>
                                        <td>{{ $airline->planes->count() }} Unit</td>
                                        <td>
                                            @if ($airline->status == true)
                                                <span
                                                    class="bg-white border border-2 badge border-success fs-6 rounded-pill text-success fw-light"><i
                                                        class='bx bx-check-circle'></i> Aktif</span>
                                            @else
                                                <span
                                                    class="bg-white border border-2 badge border-danger fs-6 rounded-pill text-danger fw-light"><i
                                                        class='bx bx-x-circle'></i> Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm rounded-pill"
                                                data-bs-toggle="modal" data-bs-target="#editMaskapai{{ $airline->id }}">
                                                <i class='bx bx-edit'></i> Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editMaskapai{{ $airline->id }}" tabindex="-1"
                                                aria-labelledby="editMaskapaiLabel{{ $airline->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editMaskapaiLabel{{ $airline->id }}">
                                                                Edit Maskapai
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('airlines.update', $airline->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Nama
                                                                        Maskapai</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="airline_name"
                                                                        value="{{ $airline->airline_name }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Kode Maskapai
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        id="code" name="airline_code"
                                                                        value="{{ $airline->airline_code }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="name"
                                                                        class="form-label">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="code" name="country"
                                                                        value="{{ $airline->country }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status
                                                                        Maskapai</label>
                                                                    <select class="form-select" id="status"
                                                                        name="status">
                                                                        <option value="1"
                                                                            {{ $airline->status == 1 ? 'selected' : '' }}>
                                                                            Aktif</option>
                                                                        <option value="0"
                                                                            {{ $airline->status == 0 ? 'selected' : '' }}>
                                                                            Tidak Aktif</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="logo" class="form-label">Logo
                                                                        Maskapai</label>
                                                                    <input type="file" class="form-control"
                                                                        id="logo" name="logo">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Edit
                                                                    Maskapai</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('airlines.destroy', $airline->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus maskapai ini?')">
                                                    <i class='bx bx-trash'></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $airlines->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
