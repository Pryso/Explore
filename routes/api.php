<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('product',\App\Http\Controllers\Api\ProductController::class,['only' => ['index','show']]);
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('product/{id}/buy',[\App\Http\Controllers\Api\MainController::class, 'buy']);
    Route::post('product/{id}/review',[\App\Http\Controllers\Api\ReviewController::class,'store']);
    Route::apiResource('product',\App\Http\Controllers\Api\ProductController::class, ['except' => ['index','show']]);
});

Route::apiResource('category', \App\Http\Controllers\Api\CategoryController::class);
Route::post('product/filter',[\App\Http\Controllers\Api\MainController::class, 'filter']);
Route::post('/categories',[\App\Http\Controllers\Api\MainController::class, 'categories']);
