@extends('layouts.dashboard')

@section('content')
    <h3><i class='bx bx-wallet-alt' ></i> Master Payment</h3>
    <x-notify />
    <div class="row">
        <div class="col-xl-4">
            <div class="shadow-sm card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0 border border-2 badge text-warning bg-dark border-warning fs-5 radius-10">Tambah Metode Pembayaran</h1>
                    </div>
                    <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3 row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo Metode Pembayaran</label>
                                    <input type="file" class="form-control" name="logo" id="logo">
                                </div>
                                <div class="mb-3">
                                    <label for="payment_name" class="form-label">Nama Metode Pembayaran</label>
                                    <input type="text" class="form-control" name="payment_name" id="payment_name"
                                        placeholder="OVO">
                                </div>
                                <div class="mb-3">
                                    <label for="payment_to" class="form-label">Penerima Dana</label>
                                    <input type="text" class="form-control" name="payment_to" id="payment_to"
                                        placeholder="PT. OVO Indonesia">
                                </div>
                                <div class="mb-3">
                                    <label for="payment_number" class="form-label">No. Rekening/VA</label>
                                    <input type="text" class="form-control" name="payment_number" id="payment_number"
                                        placeholder="2122331344">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status" required>
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success rounded-pill">Tambah Metode Pembayaran</button>
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
                                    <th>Nama Metode Pembayaran</th>
                                    <th>No. Rekening/VA</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="gap-3 d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $payment->logo) }}" alt="logo"
                                                    class="img-fluid" style="max-width: 50px">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold">{{ $payment->payment_name }}</span>
                                                    <span>A/N.{{ $payment->payment_to }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $payment->payment_number }}</td>
                                        <td>
                                            @if ($payment->status == 1)
                                                <span class="bg-white border border-2 badge border-success fs-6 rounded-pill text-success fw-light"><i class='bx bx-check-circle' ></i> Aktif</span>
                                            @else
                                                <span class="bg-white border border-2 badge border-danger fs-6 rounded-pill text-danger fw-light"><i class='bx bx-x-circle' ></i> Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning rounded-pill btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $payment->id }}">
                                                <i class="bx bx-edit"></i>Edit
                                            </button>

                                            <div class="modal fade" id="editModal{{ $payment->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $payment->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $payment->id }}">
                                                                Edit Metode Pembayaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="logo" class="form-label">Logo Metode
                                                                        Pembayaran</label>
                                                                    <input type="file" class="form-control" name="logo" id="logo">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="payment_name" class="form-label">Nama Metode
                                                                        Pembayaran</label>
                                                                    <input type="text" class="form-control" name="payment_name"
                                                                        id="payment_name" value="{{ $payment->payment_name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="payment_to" class="form-label">Penerima
                                                                        Dana</label>
                                                                    <input type="text" class="form-control" name="payment_to"
                                                                        id="payment_to" value="{{ $payment->payment_to }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="payment_number" class="form-label">No.
                                                                        Rekening/VA</label>
                                                                    <input type="text" class="form-control" name="payment_number"
                                                                        id="payment_number" value="{{ $payment->payment_number }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select class="form-select" name="status" id="status" required>
                                                                        <option value="" selected disabled>Pilih Status</option>
                                                                        <option value="1" {{ $payment->status == 1 ? 'selected' : '' }}>
                                                                            Aktif</option>
                                                                        <option value="0" {{ $payment->status == 0 ? 'selected' : '' }}>
                                                                            Tidak Aktif</option>
                                                                    </select>
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
                                        <td colspan="4" class="text-center">Data Kota Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
