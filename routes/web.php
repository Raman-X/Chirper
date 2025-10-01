<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [ChirpController::class, 'index']);
Route::post('/chirps', [ChirpController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
    Route::post('/logout', [Login::class, 'destroy']);
});

Route::view('/register', 'auth.register')->name('register')->middleware('guest');
Route::post('/register', Register::class)->middleware('guest');

Route::get('/login', [Login::class, 'create']);
Route::post('/login', [Login::class, 'store']);
