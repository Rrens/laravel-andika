<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
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

        $cart_check = Cart::where('user_id', auth()->id())
                          ->where('product_id', $request->product_id)
                          ->first();

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

    public function destroy($id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cart->delete();

        Alert::success('Sukses', 'Produk berhasil dihapus dari keranjang.');
        return redirect()->back();
    }

    public function invoice()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            Alert::warning('Peringatan', 'Keranjang belanja Anda kosong.');
            return redirect()->route('product');
        }

        return view('invoice', compact('carts'));
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            Alert::error('Error', 'Keranjang belanja Anda kosong.');
            return redirect()->route('product');
        }

        $total = $request->input('total_amount', 0);

        try {
            Mail::to($user->email)->send(new InvoiceMail($carts, $user, $total));

            Cart::where('user_id', $user->id)->delete();

            Alert::success('Checkout Berhasil', 'Pembayaran diterima dan invoice telah dikirimkan ke email Anda.');
            return redirect()->route('product');
        } catch (\Exception $e) {
            Alert::error('Kesalahan', 'Gagal mengirim email invoice: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
