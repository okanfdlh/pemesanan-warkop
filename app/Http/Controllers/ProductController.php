<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{


    protected $fillable = ['name', 'image', 'price', 'category'];
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
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    $product = Product::create($request->all());

    return response()->json([
        'message' => 'Produk berhasil ditambahkan',
        'product' => $product
    ], 201);
}
public function show($id) {
    $product = Product::findOrFail($id);
    return view('produk.detail', compact('product'));
}

}
