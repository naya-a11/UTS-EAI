<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/history', function () {
    return view('history-cinta.history');
})->name('history.index');

Route::get('/view-all-movies/{tab?}', function ($tab = 'now-showing') {
    return view('viewAll-ojan.index', ['activeTab' => $tab]);
})->name('movies.view-all');
