<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/login');
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('schedules', ScheduleController::class);
    Route::resource('airlines', AirlineController::class)->except(['show']);
    Route::resource('airlines/unit', PlaneController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('kota', KotaController::class);
    Route::resource('payments', PaymentController::class);
});

Route::middleware(['auth', 'isPassenger'])->group(function () {
    Route::get('/passenger/bookings', [BookingController::class, 'showFormBooking'])->name('passenger.bookings');
    Route::get('/bookings/detail/{id}', [BookingController::class, 'showDetailBooking'])->name('passenger.bookings.detail');
    Route::post('/bookings/detail/{id}', [BookingController::class, 'storeBooking'])->name('passenger.bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'showMyBooking'])->name('passenger.my-bookings');
    Route::put('/my-bookings/{id}', [BookingController::class, 'cancelBooking'])->name('passenger.my-bookings.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
