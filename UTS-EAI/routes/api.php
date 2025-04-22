<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Test route using controller
Route::get('/test', [TestController::class, 'test']);

// Test API route
Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working!',
        'timestamp' => now()->toDateTimeString()
    ], 200);
});

// Another test route without the leading slash
Route::get('test2', function () {
    return response()->json([
        'message' => 'Second test route is working!',
        'timestamp' => now()->toDateTimeString()
    ], 200);
});

// Simplest possible test route
Route::get('test', function () {
    return ['message' => 'API is working!'];
});

// Keep other routes commented out for now
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes
Route::prefix('v1')->group(function () {
    // Add your public API routes here
});

// Protected API routes
Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    // Add your protected API routes here
});
*/ 