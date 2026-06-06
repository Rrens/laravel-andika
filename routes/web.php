<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/login', function() {
//     $data = User::all();

//     return view('add', compact('data'));
// });

Route::get('add-user', [UserController::class, 'index'])->name('add-user');

Route::post('buat-login', function(){
    // dd(request()->all());

    User::create([
        'name' => request('nama-panjang'),
        'email' => request('email'),
        'password' => request('password'),
    ]);

    return back();
})->name('buat-login');

Route::get('/update/{id}', function($id) {
    $data = User::find($id);
    // dd($data);
    return view('update', compact('data'));
})->name('update');

Route::post('buat-update', function(){
    $id = request('id');
    $user = User::find($id);
    // dd($user, request()->all());

    $user->update([
        'name' => request('nama-panjang'),
        'email' => request('email'),
        'password' => request('password'),
    ]);

    return redirect('/login');
})->name('buat-update');

Route::get('/delete/{id}', function($id) {
    $user = User::find($id);
    $user->delete();

    return back();
})->name('delete');
