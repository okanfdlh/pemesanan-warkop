<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'notes' => 'required|string',
        ]);

        // Buat Order ID unik
        $orderId = 'INV-' . time(); // Contoh: INV-1700000000

        // Hitung total harga
        $totalAmount = 0;
        foreach (session('cart') as $id => $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Simpan order ke database
        $order = Order::create([
            'order_id' => $orderId,
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'notes' => $request->notes,
            'total_price' => $totalAmount,
            'payment_status' => 'pending',
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Kirim data ke Midtrans
        $midtransParams = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'phone' => $order->customer_phone,
            ],
            'callbacks' => [
                'finish' => route('payment.success', ['order_id' => $order->order_id]),
            ],
        ];

        $snapToken = Snap::getSnapToken($midtransParams);

        return view('payment', compact('snapToken', 'orderId'));
    }
    public function success(Request $request)
    {
        // Ambil order berdasarkan order_id
        $order = Order::where('order_id', $request->order_id)->first();

        if ($order) {
            $order->update(['payment_status' => 'success']);
        }

        return view('payment_success', compact('order'));
    }
}
