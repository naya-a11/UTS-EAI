<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// History route
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{scheduleId}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.customer-login');
    })->name('login');

    Route::get('/customer/login', function () {
        return view('auth.customer-login');
    })->name('customer.login');

    Route::post('/customer/login', [LoginController::class, 'login'])->name('customer.login.submit');

    Route::get('/provider/login', function () {
        return view('auth.provider-login');
    })->name('provider.login');

    Route::post('/provider/login', [LoginController::class, 'providerLogin'])->name('provider.login.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
