<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

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
}

