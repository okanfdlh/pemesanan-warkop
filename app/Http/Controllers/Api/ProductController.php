<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|in:coffee,non_coffee,makanan,cemilan',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Simpan gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    // Simpan data produk
    $product = Product::create([
        'name' => $request->name,
        'category' => $request->category,
        'price' => $request->price,
        'image' => $imagePath,  // Pastikan path gambar disimpan
    ]);

    return response()->json([
        'message' => 'Produk berhasil ditambahkan',
        'product' => $product
    ], 201);
}
public function update(Request $request, $id)
{
    $product = Product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Produk tidak ditemukan'], 404);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|in:coffee,non_coffee,makanan,cemilan',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Ganti gambar jika ada file baru
    if ($request->hasFile('image')) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    // Hanya update field selain image
    $product->name = $validated['name'];
    $product->category = $validated['category'];
    $product->price = $validated['price'];
    $product->save();

    return response()->json([
        'message' => 'Produk berhasil diperbarui',
        'product' => $product
    ]);
}

public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json([
            'message' => 'Produk tidak ditemukan'
        ], 404);
    }

    // Jika ada file gambar di storage, bisa dihapus juga:
    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }
    

    $product->delete();

    return response()->json([
        'message' => 'Produk berhasil dihapus'
    ], 200);
}
}
