<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use App\Models\Stores;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();

        // Bila ingin melihat Dalam Store ada product apa aja
        $store = Stores::with('products')->get();
        // Kalau mau nama product nya $store[0]->products[0]->name

        // Bila ingin melihat produk ini store nya apa
        $product = Products::with('store')->get();
        dd($store, $product);
        return view('add', compact('data'));
    }
}
