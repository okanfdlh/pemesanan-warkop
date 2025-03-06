<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{
    use HasFactory;

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

}
