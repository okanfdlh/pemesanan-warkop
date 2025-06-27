<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Ambil semua order
    public function index()
    {
        $orders = Order::with('orderItems')->get();

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
    public function getPendapatan(Request $request)
{
    $orders = DB::table('orders')
        ->select(DB::raw('DATE(created_at) as tanggal'), DB::raw('SUM(total_price) as jumlah'))
        ->where('status', 'Selesai')
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('tanggal', 'asc')
        ->get();

    return response()->json($orders);
}





public function storeCashOrder(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'     => 'required|string|max:255',
        'phone'    => 'required|string|max:20',
        'no_meja'  => 'required|string|max:10',
        'note'     => 'nullable|string',
        'items'    => 'required|array|min:1',
        'items.*.name'     => 'required|string',
        'items.*.price'    => 'required|numeric',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Hitung total harga
    $total = collect($request->items)->sum(function ($item) {
        return $item['price'] * $item['quantity'];
    });

    // Simpan order
    $order = Order::create([
        'name'        => $request->name,
        'phone'       => $request->phone,
        'no_meja'     => $request->no_meja,
        'note'        => $request->note,
        'total_price' => $total,
        'status'      => 'Diproses',
        'user_id'     => Auth::id(), // jika pakai auth
    ]);

    // Simpan detail item
    foreach ($request->items as $item) {
        OrderItems::create([
            'order_id' => $order->id,
            'name'     => $item['name'],
            'price'    => $item['price'],
            'qty'      => $item['quantity'],
        ]);
    }

    return response()->json([
        'message' => 'Pesanan berhasil disimpan.',
        'order' => $order->load('orderItems')
    ], 200);
}
}