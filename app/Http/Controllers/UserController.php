<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();

        return view('add', compact('data'));
    }

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

        $user->delete();

        return back();
    }
}