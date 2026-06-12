<?php

<<<<<<< HEAD
=======
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Models\User;
>>>>>>> fac5b0eb8e495529a37dc3c9594bab0727e039f0
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
<<<<<<< HEAD
=======
use App\Http\Controllers\ProductController;
>>>>>>> fac5b0eb8e495529a37dc3c9594bab0727e039f0

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/login', [UserController::class, 'index'])->name('login');

Route::post('/buat-login', [UserController::class, 'store'])->name('buat-login');

Route::get('/update/{id}', [UserController::class, 'edit'])->name('update');

Route::post('/buat-update', [UserController::class, 'update'])->name('buat-update');

Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
=======

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

>>>>>>> fac5b0eb8e495529a37dc3c9594bab0727e039f0
