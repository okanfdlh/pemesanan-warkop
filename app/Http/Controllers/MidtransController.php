<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Midtrans\Transaction;

class MidtransController extends Controller
{
    

    public function paymentSuccess(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        
        if ($order) {
            // Ubah status order jadi "Selesai"
            $order->status = 'Selesai';
            $order->save();

            // Hapus session keranjang
            Session::forget('cart');

            // Redirect ke halaman cetak struk
            return redirect()->route('order.receipt', ['order_id' => $order->id]);
        }

        return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
    }
    public function downloadReceiptPDF($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        
        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        $pdf = Pdf::loadView('order.receipt_pdf', compact('order'));
        return $pdf->download('Struk_Pembayaran_'.$order->order_id.'.pdf');
    }
    
    public function createSnapToken(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        $order = Order::create([
            'order_id' => 'ORDER-' . uniqid(),
            'total_price' => $request->total_price,
            'status' => 'Pending',
            // tambahkan atribut lain jika perlu
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => 'Pelanggan',
                'email' => 'pelanggan@example.com',
            ],
            'enabled_payments' => ['qris', 'gopay', 'bank_transfer'], // opsional
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('order.detail', compact('order', 'snapToken'));
    }
}

