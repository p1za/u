@extends('layouts.dashboard')

@section('content')
    <h3><i class='bx bx-buildings' ></i> Master Kota</h3>
    <x-notify />
    <div class="row">
        <div class="col-xl-4">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0 border border-2 badge bg-dark text-warning border-warning fs-5 radius-10">Tambah Kota</h1>
                    </div>
                    <form action="{{ route('kota.store') }}" method="POST">
                        @csrf
                        <div class="mt-3 row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama_kota" class="form-label">Nama Kota</label>
                                    <input type="text" class="form-control" name="nama_kota" id="nama_kota"
                                        placeholder="Jakarta">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_kota" class="form-label">Kode Kota <small class="text-danger">Maks: 3 Karakter</small></label>
                                    <input type="text" class="form-control" name="kode_kota" id="kode_kota"
                                        placeholder="JKT">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success rounded-pill">Tambah Kota</button>
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
                                    <th>Nama Kota</th>
                                    <th>Kode Kota</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($kotas as $kota)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kota->nama_kota }}</td>
                                        <td>{{ $kota->kode_kota }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning rounded-pill btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $kota->id }}">
                                                <i class="bx bx-edit"></i>Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $kota->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $kota->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $kota->id }}">
                                                                Edit Kota</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('kota.update', $kota->id) }}" method="POST">
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="nama_kota{{ $kota->id }}"
                                                                        class="form-label">Nama Kota</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_kota" id="nama_kota{{ $kota->id }}"
                                                                        value="{{ $kota->nama_kota }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="kode_kota{{ $kota->id }}"
                                                                        class="form-label">Kode Kota</label>
                                                                    <input type="text" class="form-control"
                                                                        name="kode_kota" id="kode_kota{{ $kota->id }}"
                                                                        value="{{ $kota->kode_kota }}">
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
                                            <form action="{{ route('kota.destroy', $kota->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill"><i
                                                        class="bx bx-trash"></i>Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data Kota Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $kotas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
