<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


Route::group([
    'prefix' => 'auth'
    ], function() {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('buat-login');
});

Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::group([
    'middleware' => ['loguser', 'role:user,admin']
], function() {
    Route::get('add-user', [UserController::class, 'index'])->name('add-user');
    Route::get('update/{id}', [UserController::class, 'update'])->name('update');
    Route::post('update', [UserController::class, 'post_update'])->name('buat-update');

    Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');

    Route::get('product', [ProductController::class, 'index'])->name('product');

    Route::group([
        'prefix' => 'cart'
    ], function(){
        Route::post('', [CartController::class, 'store'])->name('cart-store');
    });
});

