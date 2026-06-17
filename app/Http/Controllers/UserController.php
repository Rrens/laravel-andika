<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();

        return view('add', compact('data'));
    }

    public function update($id)
    {
        $data = User::find($id);

        return view('update', compact('data'));
    }

    public function post_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama-panjang' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ], [
            'email.required' => 'Email nya kudu diisi',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->input('id'));

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->update([
            'name' => $request->input('nama-panjang'),
            'email' => $request->input('email'),
            'password' => $user->password,
        ]);

        return redirect()->route('add-user');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return back();
    }
}