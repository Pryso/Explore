<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    return view('index')->with(['user' => $user]);
});

Route::get('/{path}', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    return view('index')->with(['user' => $user]);
})->where('path',".*");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->group(function() {
    Route::get('login', [App\Http\Controllers\GetController::class, 'loginUser']);
    Route::get('get', function () {
        return view('getUser');
    });
});



