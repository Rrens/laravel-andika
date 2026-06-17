<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => 'auth'
], function () {

    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('authenticate');

    Route::get('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'store'])
        ->name('buat-login');
});

Route::post('/auth/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| USER & PRODUCT
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => ['loguser', 'role:user,admin']
], function () {

    Route::get('/add-user', [UserController::class, 'index'])
        ->name('add-user');

    Route::get('/update/{id}', [UserController::class, 'update'])
        ->name('update');

    Route::post('/update', [UserController::class, 'post_update'])
        ->name('buat-update');

    Route::get('/delete/{id}', [UserController::class, 'delete'])
        ->name('delete');

    Route::get('/product', [ProductController::class, 'index'])
        ->name('product');

    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */

    Route::prefix('cart')->group(function () {

        // tambah produk ke keranjang
        Route::post('/', [CartController::class, 'store'])
            ->name('cart-store');

        // quantity +
        Route::post('/add/{id}', [CartController::class, 'add'])
            ->name('cart-add');

        // quantity -
        Route::post('/min/{id}', [CartController::class, 'min'])
            ->name('cart-min');

        // hapus item
        Route::delete('/delete/{id}', [CartController::class, 'delete'])
            ->name('cart-delete');
    });
});