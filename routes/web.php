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

    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'admin'
    ], function() {
        Route::get('product', [ProductController::class, 'adminIndex'])->name('admin.products.index');
        Route::post('product', [ProductController::class, 'adminStore'])->name('admin.products.store');
        Route::put('product/{id}', [ProductController::class, 'adminUpdate'])->name('admin.products.update');
        Route::delete('product/{id}', [ProductController::class, 'adminDestroy'])->name('admin.products.destroy');
    });