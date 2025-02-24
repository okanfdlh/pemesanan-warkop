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
}
