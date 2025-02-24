<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Tambah produk ke keranjang
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += (int) $request->quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "image" => $product->image,
                "price" => $product->price,
                "quantity" => (int) $request->quantity
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['message' => 'Produk ditambahkan ke keranjang']);
    }

    // Tampilkan keranjang belanja
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
    }

    // Fungsi untuk menghapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
