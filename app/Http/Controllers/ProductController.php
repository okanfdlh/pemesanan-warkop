<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all(); // Mengambil semua produk dari database
    $categories = [
        'coffe' => 'Coffee',
        'nCoffe' => 'Non Coffee',
        'makanan' => 'Makanan',
        'cemilan' => 'Cemilan'
    ];
    
    return view('home', compact('products', 'categories'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'image' => 'required|string',
        'price' => 'required|numeric',
        'category' => 'required|string',
    ]);

    $product = Product::create([
        'name' => $request->name,
        'image' => $request->image,
        'price' => $request->price,
        'category' => $request->category,
    ]);

    return response()->json([
        'message' => 'Product successfully created',
        'product' => $product
    ], 201);
}

}
