<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
        $user->delete();

        return back();
    }
}
