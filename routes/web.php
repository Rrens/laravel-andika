<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->name('login');

Route::post('/buat-login', [UserController::class, 'store'])->name('buat-login');

Route::get('/update/{id}', [UserController::class, 'edit'])->name('update');

Route::post('/buat-update', [UserController::class, 'update'])->name('buat-update');

Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('delete');