<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer/login', function () {
    return view('auth.customer-login');
})->name('customer.login');

Route::get('/provider/login', function () {
    return view('auth.provider-login');
})->name('provider.login');
