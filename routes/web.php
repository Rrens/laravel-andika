<?php

use App\Models\User;
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
    return view('welcome');
});

Route::get('/login', function() {
    $data = User::all();

    return view('login', compact('data'));
});

Route::post('buat-login', function(){
    // dd(request()->all());

    User::create([
        'name' => request('nama-panjang'),
        'email' => request('email'),
        'password' => request('password'),
    ]);

    return back();
})->name('buat-login');

