<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('page')->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/register', function () {
        return view('test-endpoint.authe');
    });

    Route::get('/login', function () {
        return view('test-endpoint.logine');
    });
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
