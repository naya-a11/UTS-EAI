<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HistoryController;
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

Route::get('/details', function () {
    return view('movie_details-fuad.details');
})->name('movie.details');

Route::get('/booking', function () {
    return view('movie_details-fuad.booking');
})->name('movie.booking');

Route::get('/view-all-movies/{tab?}', function ($tab = 'now-showing') {
    return view('viewAll-ojan.index', ['activeTab' => $tab]);
})->name('movies.view-all');

// Payment Routes
Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// Test route
Route::get('/test-web', function () {
    return response()->json([
        'message' => 'Web route is working!',
        'status' => 'success'
    ]);
});

// API Test route
Route::get('/api-test', function () {
    return view('api-test');
});

// Add this new route before your existing routes
Route::get('/test-route', function () {
    return 'Basic routing is working!';
});


