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

        Alert::success('Sukses', 'Produk berhasil ditambahkan ke keranjang.');
        return back();
    }

    /**
     * Hapus produk dari keranjang
     */
    public function destroy($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->findOrFail($id);

        $cart->delete();

        Alert::success('Sukses', 'Produk berhasil dihapus dari keranjang.');
        return redirect()->back();
    }

    /**
     * Tampilkan halaman invoice
     */
    public function invoice()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            Alert::warning('Peringatan', 'Keranjang belanja Anda kosong.');
            return redirect()->route('product');
        }

        return view('invoice', compact('carts'));
    }

    /**
     * Checkout dan kirim invoice ke email
     */
    public function checkout(Request $request)
    {
        $user = auth()->user();

        $carts = Cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($carts->isEmpty()) {
            Alert::warning('Peringatan', 'Keranjang Anda kosong.');
            return redirect()->route('product');
        }

        $total = 0;

        foreach ($carts as $cart) {

            if (!$cart->product) {
                continue;
            }

            $itemPrice = $cart->product->price;

            if ($cart->product->discount) {
                $itemPrice = $cart->product->price * (1 - ($cart->product->discount / 100));
            }

            $subtotal = $itemPrice * $cart->quantity;
            $total += $subtotal;
        }

        Mail::to($user->email)
            ->send(new InvoiceMail($carts, $user, $total));

        // Hapus keranjang setelah checkout
        Cart::where('user_id', $user->id)->delete();

        Alert::success(
            'Pembayaran Berhasil',
            'Invoice berhasil dikirim ke email Anda.'
        );

        return redirect()->route('product');
    }
}