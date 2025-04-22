<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Remove the api prefix since RouteServiceProvider already adds it
Route::get('test', function() {
    return response()->json(['message' => 'API is working']);
});

// Todo routes
Route::get('todos', [TodoController::class, 'index']);
Route::post('todos', [TodoController::class, 'store']);

// Get a specific todo
Route::get('todos/{todo}', [TodoController::class, 'show']);

// Update a todo
Route::put('todos/{todo}', [TodoController::class, 'update']);

// Delete a todo
Route::delete('todos/{todo}', [TodoController::class, 'destroy']); 