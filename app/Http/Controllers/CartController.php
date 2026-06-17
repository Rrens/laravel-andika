<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Tambah produk ke keranjang
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $request->product_id,
                'quantity'   => 1,
            ]);
        }

        return back();
    }

    /**
     * Quantity +
     */
    public function add($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->quantity += 1;
        $cart->save();

        return back();
    }

    /**
     * Quantity -
     */
    public function min($id)
    {
        $cart = Cart::findOrFail($id);

        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
        }

        return back();
    }

    /**
     * Hapus item dari keranjang
     */
    public function delete($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return back();
    }
}