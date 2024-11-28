<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\CountryController;
use App\Http\Controllers\V1\ItemController;
use App\Http\Controllers\V1\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=> 'v1', 'namespace' => 'App\Http\Controllers\V1'], function(){
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('countries', CountryController::class);
    Route::apiResource('transactions',TransactionController::class);
    Route::apiResource('items',ItemController::class);
    Route::post('auth/register',[AuthController::class, 'register']);
    Route::post('auth/login',[AuthController::class, 'login']);
});

