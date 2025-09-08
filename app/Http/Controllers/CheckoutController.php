<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Session;
use App\Helpers\PaymentHelper;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_meja' => 'required|digits_between:1,25',
            'phone' => 'required|digits_between:10,15',
            'note' => 'nullable|string|max:500',
        ]);

        $orderId = 'INV-' . time();
        $totalAmount = 0;

        // Hitung total harga dari session cart
        if (session()->has('cart')) {
            foreach (session('cart') as $id => $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }
        }

        // Hitung Hybrid Fee
        $paymentDetails = PaymentHelper::calculateHybridFee($totalAmount);
        
        // Simpan order ke database
        $order = Order::create([
            'order_id'       => $orderId,
            'customer_name'  => $request->name,
            'customer_meja'  => $request->no_meja,
            'customer_phone' => $request->phone,
            'notes'          => $request->note ?? '',
            'total_price'    => $paymentDetails['total_order'],
            'fee_platform'   => $paymentDetails['fee_platform'],
            'total_bayar'    => $paymentDetails['total_bayar'],
            'payment_status' => 'pending',
        ]);

        // Simpan order_id ke session
        session(['order_id' => $order->id]);
        
        // Simpan payment details ke session untuk ditampilkan di halaman pembayaran
        session(['payment_details' => $paymentDetails]);

        // Simpan detail produk ke order_items
        if (session()->has('cart')) {
            foreach (session('cart') as $id => $item) {
                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_name'=> $item['name'],
                    'quantity'    => $item['quantity'],
                    'price'       => $item['price'],
                    'subtotal'    => $item['price'] * $item['quantity'],
                ]);
                
                // Kurangi stok produk kalau method tersedia
                $product = \App\Models\Product::where('name', $item['name'])->first();
                if ($product && method_exists($product, 'decreaseStock')) {
                    $product->decreaseStock($item['quantity']);
                }
            }
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Kirim data ke Midtrans (gunakan total_bayar yang sudah termasuk fee)
        $midtransParams = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => $paymentDetails['total_bayar'],
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'phone'      => $order->customer_phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($midtransParams);

        return view('payment', compact('snapToken', 'order', 'paymentDetails'));
    }

    public function success(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();

        if ($order) {
            $order->payment_status = 'Selesai';
            $order->save();

            if (session()->has('cart')) {
                Session::forget('cart');
            }

            return redirect()->route('order.receipt', ['order_id' => $order->id]);
        }

        return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
    }

    public function index()
    {
        $order = Order::where('id', session('order_id'))->first() ??
                 Order::latest()->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Tidak ada pesanan yang ditemukan.');
        }

        // ✅ Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $transaction = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'phone'      => $order->customer_phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($transaction);

        return view('payment', compact('order', 'snapToken'));
    }
}
