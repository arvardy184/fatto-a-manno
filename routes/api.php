<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/addClothes', [ClothesController::class, 'addClothes']);
Route::post('/editClothes/{cloth_id}', [ClothesController::class, 'editClothes']);
Route::post('/editStock/{cloth_id}/{storage_id}', [ClothesController::class, 'editStock']);
Route::get('/clothesQuantity/{id}', [ClothesController::class, 'findClothWithTotalQuantity']);
Route::get('/deleteClothes/{id}', [ClothesController::class, 'deleteClothes']);
Route::get('/getClothes', [ClothesController::class, 'getAllClothes']);
