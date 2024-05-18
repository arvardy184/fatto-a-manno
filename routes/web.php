<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;


// tolong linkan middleware ke semua nya 

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

Route::group([
], function () {
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
    Route::get('/all_products', [ClothesController::class, 'getClothesbyAttribute'])->name('All Products');
});

Route::group([
    'prefix' => 'dashboard'
], function () {

    //user dan admin
    Route::get('/profile', function () {
        return view('profile', ['title' => 'Profil']);
    })->name('Profile');

    //user
    Route::get('/edit_profil', function () {
        return view('User.edit_profil', ['title' => 'Edit Profil']);
    })->name('Edit Profil');
    Route::get('/ubah_password', function () {
        return view('edit_profil', ['title' => 'Ubah Password']);
    })->name('Ubah Password');

    //admin
    Route::get('/data_pengguna', [UserController::class, 'getAllUsers'])->name('Data Pengguna');

    //clothes
    Route::get('/data_pakaian', [ClothesController::class, 'getAllClothes'])->name('Data Pakaian');
    Route::get('/data_pakaian/tambah', function () {
        return view('Clothes.tambah_pakaian', ['title' => 'Tambah Pakaian']);
    })->name('Tambah Pakaian');

    //storage
    Route::get('/data_storage/tambah', function () {
        return view('Storage.tambah_storage', ['title' => 'Tambah Gudang']);
    })->name('Tambah Gudang');

    Route::get('/detail_items', function () {
        return view('Storage.detail_items', ['title' => 'Detail Items']);
    })->name('Detail Items');
});


//CONTROLLERS

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

//ADMIN ===========================================================================================
//Clothes
Route::group([
    'prefix' => 'clothes'
], function () {
    Route::post('/add', [ClothesController::class, 'addClothes']);
    Route::post('/edit/{cloth_id}', [ClothesController::class, 'editClothes']);
    Route::post('/edit/stock/{cloth_id}/{storage_id}', [ClothesController::class, 'editStock']);
    Route::get('/quantity/{id}', [ClothesController::class, 'findClothWithTotalQuantity']);
    Route::get('/delete/{id}', [ClothesController::class, 'deleteClothes']);
    Route::get('/', [ClothesController::class, 'getAllClothes']);
    Route::get('/{id}', [ClothesController::class, 'getClothesbyId']);
    Route::get('/data/{id}', [ClothesController::class, 'getDataEditClothes']);
});

//Storage ===========================================================================================
Route::group([
    'prefix' => 'storage'
], function () {
    Route::post('/add', [StorageController::class, 'addStorage']);
    Route::post('/edit/{cloth_id}', [StorageController::class, 'editStorage']);
    Route::delete('/delete/{id}', [StorageController::class, 'deleteStorage']);
    Route::get('/', [StorageController::class, 'getAllStorage'])->name('Data Gudang');
    Route::get('/{id}', [StorageController::class, 'getStoragebyId']);
    Route::get('/data/{id}', [StorageController::class, 'getDataEditStorage']);
});

//BUY ===========================================================================================
Route::group(['prefix' => 'buy'], function () {
    Route::post('/add', [BuyController::class, 'addBuy']);
    Route::put('/edit/{id}', [BuyController::class, 'editBuy']);
    Route::delete('/delete/{id}', [BuyController::class, 'deleteBuy']);
    Route::get('/', [BuyController::class, 'getAllBuys']);
    Route::get('/{id}', [BuyController::class, 'getBuybyId']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/{id}', [UserController::class, 'getUserbyId']);
    Route::post('/add', [UserController::class, 'createUser']);
    Route::put('/edit/{id}', [UserController::class, 'updateUser']);
    Route::post('/delete/{id}', [UserController::class, 'deleteUser']);
    Route::get('/data/{id}', [UserController::class, 'getDataEditUser']);
});


Route::post('/hook', [AdminController::class, 'webhook']);