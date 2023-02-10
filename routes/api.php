<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
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
        Route::group(['prefix' => 'accounts', 'as' => 'account.'], function () {
            Route::get('/', [AccountController::class, 'index'])->name('index');
            Route::get('/{account_id}', [AccountController::class, 'show'])->name('show');
        });
        Route::group(['prefix' => 'balances', 'as' => 'balance.'], function () {
            Route::post('/{account_id}', [BalanceController::class, 'store'])->name('store');
        });
    });
});

