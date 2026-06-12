<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Failed to add product to cart');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart_check = Cart::where('product_id', $request->product_id)->first();

        if ($cart_check) {
            $cart_check->quantity += 1;
            $cart_check->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
}
