<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

Route::get('/details/{id?}', function ($id = null) {
    return view('movie_details-fuad.details', ['movieId' => $id]);
})->name('movie.details');

Route::get('/booking/{id?}', [BookingController::class, 'create'])->name('movie.booking');
Route::post('/store-booking-data', [BookingController::class, 'storeBookingData'])->name('booking.store');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

Route::get('/view-all-movies/{tab?}', function ($tab = 'now-showing') {
    return view('viewAll-ojan.index', ['activeTab' => $tab]);
})->name('movies.view-all');


