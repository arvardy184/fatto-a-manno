<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;


// tolong linkan middleware ke semua nya 

Route::group([], function () {
    Route::get('/', function () {
        return view('Guest.home', ['title' => 'Home']);
    })->name('home')->middleware('redirectDashboard');

    Route::get('/login', function () {
        return view('Guest.login', ['title' => 'Login']);
    })->name('login')->middleware('redirectDashboard');

    Route::get('/register', function () {
        return view('Guest.register', ['title' => 'Register']);
    })->name('register')->middleware('redirectDashboard');
    Route::get('/all_products', [ClothesController::class, 'getClothesbyAttribute'])->name('All Products');
    Route::get('/deskripsi_pakaian/{id}', [ClothesController::class, 'getClothesDetail'])->name('Deskripsi Pakaian');
    Route::get('/tambah_pembayaran', [BuyController::class, 'addBuy'])->name('Deskripsi Pakaian');
    Route::get('/forgotPass', function () {
        return view('Guest.forgotPass', ['title' => 'Forgot Password']);
    })->name('forgotPass');
    Route::get('/verification_registrasion', function () {
        return view('Guest.verifikasi_register', ['title' => 'Verification Registrasion']);
    })->name('Verification Registrasion');
});

Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'loggedIn',
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
    Route::get('/data_pengguna', [UserController::class, 'getUserbyName'])->name('Data Pengguna')->middleware('isAdmin');
    Route::get('/histori_pengguna/{user_id}', [BuyController::class, 'getBuybyAttribute'])->name('Detail User')->middleware('isAdmin');

    //clothes
    Route::get('/data_pakaian', [ClothesController::class, 'getClothesbyAttributeAdmin'])->name('Data Pakaian')->middleware('isAdmin');
    Route::get('/data_pakaian/tambah', [ClothesController::class, 'getDataAddClothes'])->name('Tambah Pakaian');

    //storage
    Route::get('/data_storage/tambah', function () {
        return view('Storage.tambah_storage', ['title' => 'Tambah Gudang']);
    })->name('Tambah Gudang');

    Route::get('/histori_user', [BuyController::class, 'getBuybyAttributeCustomer'])->name('Histori User')->middleware('isCustomer');
    Route::get('/keranjang_user', [BuyController::class, 'getKeranjang'])->name('Keranjang User')->middleware('isCustomer');
    Route::get('/detail_items', [StorageController::class, 'getStorageDetail'])->name('Detail Items')->middleware('isAdmin');
    Route::get('/edit_keranjang/{id}', [BuyController::class, 'getDataEditKeranjang'])->name('Edit Keranjang')->middleware('isCustomer');
    Route::get('/data_storage', [StorageController::class, 'getStoragebyName'])->middleware('isAdmin');
    Route::post('/sales_analysis', [AdminController::class, 'analyze'])->middleware('isAdmin');
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
    'prefix' => 'clothes',
    'middleware' => 'loggedIn'
], function () {
    Route::post('/add', [ClothesController::class, 'addClothes'])->middleware('isAdmin');
    Route::post('/edit/{cloth_id}', [ClothesController::class, 'editClothes'])->middleware('isAdmin');
    Route::post('/edit/stock/{cloth_id}/{storage_id}', [ClothesController::class, 'editStock']);
    Route::get('/quantity/{id}', [ClothesController::class, 'findClothWithTotalQuantity']);
    Route::get('/delete/{id}', [ClothesController::class, 'deleteClothes'])->middleware('isAdmin');
    Route::get('/', [ClothesController::class, 'getAllClothes']);
    Route::get('/data_pakaian/att', [ClothesController::class, 'getClothesbyAttributeAdmin'])->middleware('isAdmin');
    Route::get('/{id}', [ClothesController::class, 'getClothesDetail']);
    Route::get('/data/{id}', [ClothesController::class, 'getDataEditClothes']);
});

//Storage ===========================================================================================
Route::group([
    'prefix' => 'storage',
    'middleware' => 'isAdmin'
], function () {
    Route::post('/add', [StorageController::class, 'addStorage']);
    Route::post('/edit/{id}', [StorageController::class, 'editStorage']);
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
Route::group([
    'prefix' => 'buy',
    'middleware' => 'loggedIn'
], function () {
    Route::post('/add', [BuyController::class, 'addBuy'])->middleware('isCustomer');
    Route::post('/delete/{id}', [BuyController::class, 'deleteBuy'])->middleware('isCustomer');
    Route::get('/', [BuyController::class, 'getAllBuys']);
    Route::get('/{id}', [BuyController::class, 'getBuybyId']);
    Route::get('/payment/{id}', [BuyController::class, 'editPayment']);
    Route::post('/find/{user_id}', [BuyController::class, 'getBuybyAttribute'])->middleware('isAdmin');
    Route::post('/history', [BuyController::class, 'getBuybyAttributeCustomer'])->middleware('isCustomer');
    Route::post('/cart', [BuyController::class, 'getKeranjang'])->middleware('isCustomer');
    Route::post('/cart/buy', [BuyController::class, 'payBatch'])->middleware('isCustomer');
    Route::post('/cart/delete/{id}', [BuyController::class, 'deleteKeranjang'])->middleware('isCustomer'); // Delete Keranjang + refresh page
    Route::get('/cart/edit/{id}', [BuyController::class, 'getDataEditKeranjang'])->middleware('isCustomer'); // Redirect ke page edit + passing data
    Route::get('/cart/edit/buy/{id}', [BuyController::class, 'editBuy'])->middleware('isCustomer'); // Edit keranjang + redirect ke halaman keranjang
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'isAdmin'
], function () {
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
    Route::get('/', [AdminController::class, 'getAllData'])->middleware('isAdmin'); //Ini return all user to view
    Route::post('/confirm/{id}', [AdminController::class, 'confirmPayment'])->middleware('isAdmin');
    Route::post('/analyze', [AdminController::class, 'analyze'])->middleware('isAdmin');
});
