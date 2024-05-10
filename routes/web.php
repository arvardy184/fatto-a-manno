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
Route::post('/addClothes', [ClothesController::class, 'addClothes']);
Route::post('/editClothes/{id}', [ClothesController::class, 'editClothes']);
Route::post('/deleteClothes/{id}', [ClothesController::class, 'deleteClothes']);
Route::get('/getClothes', [ClothesController::class, 'getAllClothes']);

Route::get('/', function () {
    return view('Guest.home', ['title' => 'Home']);
})->name('home');

Route::get('/login', function () {
    return view('Guest.login', ['title' => 'Login']);
})->name('login');

Route::get('/register', function () {
    return view('Guest.register', ['title' => 'Register']);
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
})->name('dashboard');

//user dan admin
Route::get('/dashboard/profile', function () {
    return view('profile', ['title' => 'Profil']);
})->name('profile');

//user
Route::get('/dashboard/edit_profil', function () {
    return view('User.edit_profil', ['title' => 'Edit Profil']);
})->name('Edit Profil');

Route::get('/dashboard/ubah_password', function () {
    return view('edit_profil', ['title' => 'Ubah Password']);
})->name('Ubah Password');

//admin
Route::get('/dashboard/data_pengguna', function () {
    return view('Admin.data_pengguna', ['title' => 'Data Pengguna']);
})->name('Data Pengguna');

Route::get('/dashboard/data_pakaian', function () {
    return view('Clothes.data_pakaian', ['title' => 'Data Pakaian']);
})->name('Data Pakaian');

Route::get('/dashboard/data_pakaian/tambah', function () {
    return view('Clothes.tambah_pakaian', ['title' => 'Tambah Pakaian']);
})->name('Tambah Pakaian');

Route::get('/dashboard/data_pakaian/edit', function () {
    return view('Clothes.edit_pakaian', ['title' => 'Edit Pakaian']);
})->name('Edit Pakaian');

