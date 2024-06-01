<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/signin', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/resend-verif', [AuthController::class, 'resendVerification']);
Route::post('/forgot', [AuthController::class, 'forgotPassword'])->name('forgotPass');

//Clothes
Route::group([
    'prefix' => 'clothes'
], function () {
    Route::post('/add', [ClothesController::class, 'addClothes']);
    Route::post('/edit/{cloth_id}', [ClothesController::class, 'editClothes']);
    Route::post('/edit/stock/{cloth_id}/{storage_id}', [ClothesController::class, 'editStock']);
    Route::get('/quantity/{id}', [ClothesController::class, 'findClothWithTotalQuantity']);
    Route::get('/delete/{id}', [ClothesController::class, 'deleteClothes']);
    // Route::get('/', [ClothesController::class, 'getAllClothes']);
    Route::get('/{id}', [ClothesController::class, 'getClothesbyId']);
    Route::get('/', [ClothesController::class, 'getClothesbyAttribute']);
});

//Storage
Route::group([
    'prefix' => 'storage'
], function () {
    Route::post('/add', [StorageController::class, 'addStorage']);
    Route::post('/edit/{cloth_id}', [StorageController::class, 'editStorage']);
    Route::delete('/delete/{id}', [StorageController::class, 'deleteStorage']);
    Route::get('/', [StorageController::class, 'getAllStorage'])->name('Data Gudang');
    Route::get('/{id}', [StorageController::class, 'getStoragebyId']);
    Route::get('/data/{id}', [StorageController::class, 'getDataEditStorage']);
    Route::get('/clothes/{id}', [StorageController::class, 'getStorageDetail']);
    Route::get('/clothes/data/{id}', [StorageController::class, 'editStock']);
});

//USER ===========================================================================================

Route::group([
    'prefix' => 'user'
], function () {
    Route::get('/', [UserController::class, 'getAllUsers']);
    Route::get('/{id}', [UserController::class, 'getUserbyId']);
    Route::get('/profile', [UserController::class, 'getProfile']);
    Route::post('/', [UserController::class, 'getUserbyName']);
});

//BUY ===========================================================================================

Route::group(['prefix' => 'buy'], function () {
    Route::post('/add', [BuyController::class, 'addBuy']);
    Route::put('/edit/{id}', [BuyController::class, 'editBuy']);
    Route::delete('/delete/{id}', [BuyController::class, 'deleteBuy']);
    Route::get('/', [BuyController::class, 'getAllBuys']);
    Route::get('/data/{id}', [BuyController::class, 'getBuybyId']);
    Route::get('/detail/{user_id}', [BuyController::class, 'getBuybyAttribute']);
    Route::get('/cart', [BuyController::class, 'getKeranjang']);
});


Route::post('/pay', [AdminController::class, 'test']);
Route::post('/hook', [AdminController::class, 'webhook']);
Route::post('/analyze', [AdminController::class, 'getAnalysis']);
