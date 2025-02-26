<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Ambil semua order
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    // Ambil order berdasarkan ID
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        return response()->json($order);
    }
}
