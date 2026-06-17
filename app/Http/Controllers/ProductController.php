<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;

class ProductController extends Controller
{
    public function index()
{
    $products = Products::all();

    $carts = Cart::join('products', 'carts.product_id', '=', 'products.id')
        ->select('carts.*', 'products.name', 'products.price')
        ->where('carts.user_id', auth()->id())
        ->get();

    return view('products', compact('products', 'carts'));
}
}