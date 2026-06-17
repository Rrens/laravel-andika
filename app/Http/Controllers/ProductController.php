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
        $products = Products::with('store')->get();
        $carts = Cart::all();
        $stores = stores::all();

        return view('products', compact('products', 'carts', 'stores'));
    }

    public function adminIndex()
    {
        $products = Products::with('store')->get();
        $stores = stores::all();
        return view('admin_products', compact('products', 'stores'));
    }

    public function adminStore(Request $request)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'is_sold' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->messages()->all()[0]);
            return back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Products::create([
            'store_id' => $request->store_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'is_sold' => $request->is_sold,
            'image' => $imagePath,
        ]);

        Alert::success('Sukses', 'Produk berhasil ditambahkan.');
        return redirect()->route('admin.products.index');
    }

    public function adminUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'is_sold' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->messages()->all()[0]);
            return back()->withErrors($validator)->withInput();
        }

        $product = Products::findOrFail($id);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'store_id' => $request->store_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'is_sold' => $request->is_sold,
            'image' => $imagePath,
        ]);

        Alert::success('Sukses', 'Produk berhasil diupdate.');
        return redirect()->route('admin.products.index');
    }

    public function adminDestroy($id)
    {
        $product = Products::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        Alert::success('Sukses', 'Produk berhasil dihapus.');
        return redirect()->route('admin.products.index');
    }
}
