<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $carts = Cart::all();

        return view('products', compact('products', 'carts'));
    }
}