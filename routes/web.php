<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClothesController;
use Illuminate\Support\Facades\Route;


//TEST VIEW
Route::prefix('page')->group(function () {
    Route::get('/register', function () {
        return view('test-endpoint.authe');
    })->name('page-register');

    Route::get('/login', function () {
        return view('test-endpoint.logine');
    })->name('page-login');

    Route::get('/testing', function () {
        return view('test-endpoint.test-func');
    })->name('page-test');
});

//Auth
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/signin', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/email/verify/{id}', [AuthController::class, 'mailVerification'])->name('verifyMail');
Route::any('/test', function () {
    return response()->json([
        'data' => 'aaaaaaaaaa'
    ]);
})->middleware('isAdmin');
//Admin
Route::post('/addClothes', [ClothesController::class, 'addClothes'])->middleware('isAdmin');
Route::post('/editClothes/{id}', [ClothesController::class, 'editClothes'])->middleware('isAdmin');
Route::post('/deleteClothes/{id}', [ClothesController::class, 'deleteClothes'])->middleware('isAdmin');
Route::post('/getClothes', [ClothesController::class, 'getAllClothes']);

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
})->name('home');

Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
});

Route::get('/register', function () {
    return view('register', ['title' => 'Register']);
});
