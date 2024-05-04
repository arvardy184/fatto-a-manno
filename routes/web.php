<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//TEST VIEW
Route::prefix('page')->group(function () {
    Route::get('/register', function () {
        return view('test-endpoint.authe');
    })->name('page-register');

    Route::get('/login', function () {
        return view('test-endpoint.logine');
    })->name('page-login');
});

//CONTROLLER
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::any('/test', function () {
    return response()->json([
        'data' => 'aaaaaaaaaa'
    ]);
})->middleware('isAdmin');

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/blog', function () {
    return view('blog', ['title' => 'Blog']);
});

Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/register', function () {
    return view('register', ['title' => 'Register']);
});
