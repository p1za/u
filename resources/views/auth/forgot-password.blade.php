@extends('layouts.auth')

@section('content')
    <div class="text-center">
        <h3 class="">Lupa kata sandi | E - Ticketing</h3>
    </div>
    <x-notify />
    <form class="pb-3 row g-3" action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="col-12">
            <label for="inputEmailAddress" class="form-label">Alamat email</label>
            <input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="syaddad@gmail.com"
                required />
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="py-2 rounded-3 btn btn-dark">
                    <i class="bx bxs-lock-open"></i>Kirim tautan reset kata sandi
                </button>
            </div>
        </div>
    </form>
@endsection
