<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\StorageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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
});

//Storage
Route::group([
    'prefix' => 'storage',
    'middleware' => 'isAdmin'
], function () {
    Route::post('/add', [StorageController::class, 'addStorage']);
    Route::post('/edit/{cloth_id}', [StorageController::class, 'editStorage']);
    Route::get('/delete/{id}', [StorageController::class, 'deleteStorage']);
    Route::get('/', [StorageController::class, 'getAllStorage']);
    Route::get('/{id}', [StorageController::class, 'getStoragebyId']);
});
