<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Helpers\PaymentHelper;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        // Ambil order berdasarkan order_id yang dikirim oleh Midtrans
        $order = Order::where('order_id', $request->order_id)->first();

        if ($order) {
            // Ubah status pembayaran menjadi sukses
            $order->update(['payment_status' => 'sukses']);
            
            // Hitung ulang detail pembayaran untuk ditampilkan
            $paymentDetails = PaymentHelper::calculateHybridFee($order->total_price);

            return view('payment.success', compact('order', 'paymentDetails'));
        } else {
            return redirect('/')->with('error', 'Pesanan tidak ditemukan.');
        }
    }
    
    /**
     * Menampilkan detail perhitungan Hybrid Fee untuk pesanan tertentu
     */
    public function showFeeDetails($orderId)
    {
        $order = Order::where('order_id', $orderId)->first();
        
        if (!$order) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }
        
        $paymentDetails = PaymentHelper::calculateHybridFee($order->total_price);
        
        return response()->json([
            'order_id' => $order->order_id,
            'payment_details' => $paymentDetails
        ]);
    }
}

