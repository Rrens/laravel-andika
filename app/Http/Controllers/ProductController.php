<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $carts = Cart::all();

        return view('products', compact('products', 'carts'));
    }
}
