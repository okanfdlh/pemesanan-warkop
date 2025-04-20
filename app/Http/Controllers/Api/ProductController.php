<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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

}
