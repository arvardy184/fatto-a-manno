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

Route::group([], function () {
    Route::get('/', function () {
        return view('Guest.home', ['title' => 'Home']);
    })->name('home');

    Route::get('/login', function () {
        return view('Guest.login', ['title' => 'Login']);
    })->name('login');

    Route::get('/register', function () {
        return view('Guest.register', ['title' => 'Register']);
    })->name('register');
    Route::get('/all_products', [ClothesController::class, 'getClothesbyAttribute'])->name('All Products');
    Route::get('/deskripsi_pakaian/{id}', [ClothesController::class, 'getClothesDetail'])->name('Deskripsi Pakaian');
    Route::get('/tambah_pembayaran', [BuyController::class, 'addBuy'])->name('Deskripsi Pakaian');
    Route::get('/forgotPass', function () {
        return view('Guest.forgotPass', ['title' => 'Forgot Password']);
    })->name('forgotPass');
});

Route::group([
    'prefix' => 'dashboard'
], function () {
    Route::get('/', [AdminController::class, 'getAllData'])->name('dashboard');
    //user dan admin
    Route::get('/profile', function () {
        return view('profile', ['title' => 'Profil']);
    })->name('Profile');

    //user
    Route::get('/edit_profil', function () {
        return view('edit_profil', ['title' => 'Edit Profil']);
    })->name('Edit Profil');
    Route::get('/ubah_pw', function () {
        return view('User.ubah_pw', ['title' => 'Ubah Password']);
    })->name('Ubah Password');

    //admin
    Route::get('/data_pengguna', [UserController::class, 'getUserbyName'])->name('Data Pengguna');
    Route::get('/histori_pengguna/{user_id}', [BuyController::class, 'getBuybyAttribute'])->name('Detail User');

    //clothes
    Route::get('/data_pakaian', [ClothesController::class, 'getClothesbyAttributeAdmin'])->name('Data Pakaian');
    Route::get('/data_pakaian/tambah', function () {
        return view('Clothes.tambah_pakaian', ['title' => 'Tambah Pakaian']);
    })->name('Tambah Pakaian');

    //storage
    Route::get('/data_storage/tambah', function () {
        return view('Storage.tambah_storage', ['title' => 'Tambah Gudang']);
    })->name('Tambah Gudang');

    Route::get('/histori_user', [BuyController::class, 'getBuybyAttributeCustomer'])->name('Histori User');
    Route::get('/keranjang_user', [BuyController::class, 'getKeranjang'])->name('Keranjang User');
    Route::get('/detail_items', [StorageController::class, 'getStorageDetail'])->name('Detail Items');
    Route::get('/edit_keranjang/{id}', [BuyController::class, 'getDataEditKeranjang'])->name('Edit Keranjang');
    Route::get('/data_storage', [StorageController::class, 'getStoragebyName']);
});


//CONTROLLERS

//Auth
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/signin', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/email/verify/{id}', [AuthController::class, 'mailVerification'])->name('verifyMail');
Route::post('/change-password', [AuthController::class, 'changePassword']);
Route::post('/forgot', [AuthController::class, 'forgotPassword'])->name('forgotPass'); // Forgot Pass
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
    Route::get('/data_pakaian/att', [ClothesController::class, 'getClothesbyAttributeAdmin']);
    Route::get('/{id}', [ClothesController::class, 'getClothesDetail']);
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
    Route::get('/name', [StorageController::class, 'getStoragebyName']);
    Route::get('/{id}', [StorageController::class, 'getStoragebyId']);
    Route::get('/data/{id}', [StorageController::class, 'getDataEditStorage']);
    Route::get('/clothes/{id}', [StorageController::class, 'getStorageDetail']);
    Route::get('/clothes/data/{id}', [StorageController::class, 'getDataEditStock']);
    Route::post('/clothes/edit/{id}', [StorageController::class, 'editStock']);
    Route::get('/clothes/delete/{id}', [StorageController::class, 'deleteStock']);
});

//BUY ===========================================================================================
Route::group(['prefix' => 'buy'], function () {
    Route::post('/add', [BuyController::class, 'addBuy']);
    Route::post('/delete/{id}', [BuyController::class, 'deleteBuy']);
    Route::get('/', [BuyController::class, 'getAllBuys']);
    Route::get('/{id}', [BuyController::class, 'getBuybyId']);
    Route::get('/payment/{id}', [BuyController::class, 'editPayment']);
    Route::post('/find/{user_id}', [BuyController::class, 'getBuybyAttribute']);
    Route::post('/history', [BuyController::class, 'getBuybyAttributeCustomer']);
    Route::post('/cart', [BuyController::class, 'getKeranjang']);
    Route::post('/cart/buy', [BuyController::class, 'payBatch']);
    Route::post('/cart/delete/{id}', [BuyController::class, 'deleteKeranjang']); // Delete Keranjang + refresh page
    Route::get('/cart/edit/{id}', [BuyController::class, 'getDataEditKeranjang']); // Redirect ke page edit + passing data
    Route::get('/cart/edit/buy/{id}', [BuyController::class, 'editBuy']); // Edit keranjang + redirect ke halaman keranjang
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'getAllUser']); //Ini return all user to view
    Route::get('/name', [UserController::class, 'getUserbyName']); //Ini return all user to view
    Route::get('/{id}', [UserController::class, 'getUserbyId']);
    Route::post('/add', [UserController::class, 'createUser']);
    Route::put('/edit/{id}', [UserController::class, 'updateUser']);
    Route::post('/delete/{id}', [UserController::class, 'deleteUser']);
    Route::get('/data/{id}', [UserController::class, 'getDataEditUser']); // Ini return data 1 user to view
});

Route::post('/hook', [AdminController::class, 'webhook']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'getAllData']); //Ini return all user to view
    Route::post('/confirm/{id}', [AdminController::class, 'confirmPayment']);
});
