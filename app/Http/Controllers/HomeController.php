<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Ambil semua produk dari database
        return view('home', compact('products')); // Kirim ke view utama
    }
}
