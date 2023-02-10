<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BalanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
        Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('register');
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');
    });
});

