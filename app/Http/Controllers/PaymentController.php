<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        // Ambil order berdasarkan order_id yang dikirim oleh Midtrans
        $order = Order::where('order_id', $request->order_id)->first();

        if ($order) {
            // Ubah status pembayaran menjadi sukses
            $order->update(['payment_status' => 'sukses']);

            return view('payment.success', compact('order'));
        } else {
            return redirect('/')->with('error', 'Pesanan tidak ditemukan.');
        }
    }
}

