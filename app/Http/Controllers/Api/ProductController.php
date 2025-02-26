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
        'price' => 'required|numeric',
        'category' => 'required|string',
        'image' => 'required|string'
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->category = $request->category;
    $product->image = $request->image;
    $product->save();

    return response()->json(['message' => 'Produk berhasil ditambahkan'], 201);
}
}
