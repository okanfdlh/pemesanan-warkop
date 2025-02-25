<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,15',
            'note' => 'nullable|string|max:500',
        ]);

        // Buat Order ID unik
        $orderId = 'INV-' . time();

        // Hitung total harga dari session cart
        $totalAmount = 0;
        if (session()->has('cart')) {
            foreach (session('cart') as $id => $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }
        }

        // Simpan order ke database
        $order = Order::create([
            'order_id' => $orderId,
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'notes' => $request->notes, // Perbaiki typo dari 'notes' ke 'note'
            'total_price' => $totalAmount,
            'payment_status' => 'pending',
        ]);

        // Simpan order_id ke session
        session(['order_id' => $order->id]);

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
        ];

        $snapToken = Snap::getSnapToken($midtransParams);

        return view('payment', compact('snapToken', 'order')); // ✅ Pastikan order dikirim
    }

    public function success(Request $request)
    {
        // Ambil order berdasarkan order_id
        $order = Order::where('order_id', $request->order_id)->first();

        if ($order) {
            // Ubah status pembayaran jadi sukses
            $order->payment_status = 'Selesai'; // ✅ Perbaiki dari 'status' ke 'payment_status'
            $order->save();

            // Hapus session keranjang hanya jika ada
            if (session()->has('cart')) {
                Session::forget('cart');
            }

            // Redirect ke halaman cetak struk
            return redirect()->route('order.receipt', ['order_id' => $order->id]);
        }

        return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
    }

    public function index()
    {
        // Ambil order berdasarkan sesi, jika tidak ada ambil order terbaru
        $order = Order::where('id', session('order_id'))->first() ??
                 Order::latest()->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Tidak ada pesanan yang ditemukan.');
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat transaksi dengan Midtrans
        $transaction = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'phone' => $order->customer_phone,
            ],
        ];

        // Generate Snap Token
        $snapToken = Snap::getSnapToken($transaction);

        return view('payment', compact('order', 'snapToken'));
    }
}
