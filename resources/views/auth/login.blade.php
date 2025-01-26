@extends('layouts.auth')

@section('content')
    <div class="text-center">
        <h3 class="">Masuk | E - Ticketing</h3>
    </div>
    <x-notify />
    <form class="row g-3" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="col-12">
            <label for="inputEmailAddress" class="form-label">Alamat email</label>
            <input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="syaddad@gmail.com" required />
        </div>
        <div class="col-12">
            <label for="inputChoosePassword" class="form-label">Kata sandi</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control border-end-0" name="password" placeholder="Enter Password" required />
                <a href="javascript:;" class="bg-transparent input-group-text"><i class="bx bx-hide"></i></a>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="py-2 rounded-3 btn btn-dark">
                    <i class="bx bxs-lock-open"></i>Masuk
                </button>
            </div>
        </div>
    </form>
    <div class="pt-4 text-center">
        <p>
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>
@endsection
