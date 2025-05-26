<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\CountryController;
use App\Http\Controllers\V1\ItemController;
use App\Http\Controllers\V1\TransactionController;
use App\Http\Controllers\V1\UserController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware(JwtMiddleware::class);

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    //these routes need at least a valid refresh token to go next
    Route::group([
        'middleware' => [JwtMiddleware::class]
    ], function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('countries', CountryController::class);
        Route::get('transactions/recent', [TransactionController::class, 'recent']);
        Route::apiResource('transactions', TransactionController::class);
        Route::apiResource('items', ItemController::class);
    });
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/refresh', [AuthController::class, 'refresh']);
});
