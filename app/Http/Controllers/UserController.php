<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
>>>>>>> fac5b0eb8e495529a37dc3c9594bab0727e039f0

class UserController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        $data = User::all();

        // Bila ingin melihat Dalam Store ada product apa aja
        $store = Stores::with('products')->get();
        // Kalau mau nama product nya $store[0]->products[0]->name

        // Bila ingin melihat produk ini store nya apa
        $product = Products::with('store')->get();
        // dd($store, $product);
        return view('add', compact('data'));
    }

<<<<<<< HEAD
    public function store(Request $request)
    {
        User::create([
            'name' => $request->input('nama-panjang'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return back();
    }

    public function edit($id)
    {
        $data = User::find($id);

        return view('update', compact('data'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->input('id'));

        $user->update([
            'name' => $request->input('nama-panjang'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect('/login');
    }

    public function destroy($id)
    {
        $user = User::find($id);

=======
    public function update($id){
        $data = User::find($id);
        return view('update', compact('data'));
    }

    public function post_update(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama-panjang' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ], [
            'email.required' => 'Email nya kudu diisi'
        ]);

        if (!$validator->fails()) {
            Alert::error('error', $validator->messages()->all());
            return back()->withErrors($validator)->withInput();
        }

        $id = request('id');
        $user = User::find($id);

        if ($request->filled('password')) {
            $user->password = bcrypt(request('password'));
        }

        $user->update([
            'name' => request('nama-panjang'),
            'email' => request('email'),
            'password' => $user->password,
        ]);

        return redirect()->route('add-user');
    }

    public function delete($id) {
        $user = User::find($id);
>>>>>>> fac5b0eb8e495529a37dc3c9594bab0727e039f0
        $user->delete();

        return back();
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> fac5b0eb8e495529a37dc3c9594bab0727e039f0
