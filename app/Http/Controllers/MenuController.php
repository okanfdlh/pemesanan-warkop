<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Jika menggunakan model Product untuk menu

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Ambil semua produk dari database
        return view('menu', compact('products'));
    }
}
