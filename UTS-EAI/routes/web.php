<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HistoryController;

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

Route::get('/booking/{id?}', function ($id = null) {
    return view('movie_details-fuad.booking', ['movieId' => $id]);
})->name('movie.booking');

Route::get('/view-all-movies/{tab?}', function ($tab = 'now-showing') {
    return view('viewAll-ojan.index', ['activeTab' => $tab]);
})->name('movies.view-all');

// Test route
Route::get('/test-route', function () {
    return 'Basic routing is working!';
});


