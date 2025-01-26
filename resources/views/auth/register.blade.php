@extends('layouts.auth')

@section('content')
    <div class="text-center">
        <h3 class="">Daftar | E - Ticketing</h3>
    </div>
    <x-notify />
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="inputEmailAddress" class="form-label">Nama lengkap</label>
            <input id="name" class="form-control form-control-sm" type="text" name="name"
                placeholder="Cth: Syaddad Raihan Putra" required autofocus />
        </div>

        <div class="mb-3">
            <label for="inputEmailAddress" class="form-label">Alamat email</label>
            <input id="email" class="form-control form-control-sm" type="email" name="email"
                placeholder="syaddad@gmail.com" required />
        </div>

        <div class="mb-3 row">
            <div class="col-xl-6">
                <div>
                    <label for="inputEmailAddress" class="form-label">Kata sandi</label>
                    <input id="password" class="form-control form-control-sm" type="password" name="password"
                        placeholder="********" required autocomplete="new-password" />
                </div>
            </div>
            <div class="col-xl-6">
                <div>
                    <label for="inputEmailAddress" class="form-label">Konfirmasi kata sandi</label>
                    <input id="password_confirmation" class="form-control form-control-sm" type="password"
                        name="password_confirmation" placeholder="********" required />
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="inputEmailAddress" class="form-label">No. Telepon</label>
            <input id="phone" class="form-control form-control-sm" type="text" name="phone"
                placeholder="081234567890" required />
        </div>

        <div class="mb-3">
            <label for="inputEmailAddress" class="form-label">Jenis Kelamin</label>
            <select class="form-select form-select-sm" name="gender" id="gender" required>
                <option value="" selected disabled>Pilih jenis kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="inputEmailAddress" class="form-label">Alamat Lengkap</label>
            <textarea id="address" class="form-control form-control-sm" name="address" placeholder="Jl. Kebon Jeruk No. 12"
                required></textarea>
        </div>

        <button type="submit" class="py-2 mt-4 rounded-3 btn btn-dark w-100">
            <i class="bx bxs-lock-open"></i>Daftar
        </button>
    </form>
    <div class="pt-4 text-center">
        <p>
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk sekarang</a>
        </p>
    </div>
@endsection
