<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
# 登入註冊相關
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});
Route::group(['prefix' => 'accounts', 'as' => 'account.'], function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/{account_id}', [AccountController::class, 'show'])->name('show');
});

