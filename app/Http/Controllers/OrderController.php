<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function paymentSuccess(Request $request)
{
    $order = Order::where('order_id', $request->order_id)->first();

    if ($order) {
        // Ubah status order menjadi "Selesai"
        $order->status = 'Selesai';
        $order->save();

        // Hapus semua item di session keranjang
        Session::forget('cart');

        // Tampilkan halaman sukses dengan data pesanan
        return view('payment_success', compact('order'));
    }

    return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
}

    public function printReceipt($order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('order.receipt', compact('order'));
    }

    public function downloadReceiptPDF($order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Generate PDF menggunakan Laravel DomPDF
        $pdf = Pdf::loadView('order.receipt_pdf', compact('order'));

        return $pdf->download("Struk_Order_{$order->order_id}.pdf");
    }
    public function updatePaymentStatus($orderId)
{
    $order = Order::where('order_id', $orderId)->first();

    if (!$order) {
        return response()->json(['message' => 'Order tidak ditemukan'], 404);
    }

    $order->payment_status = 'sukses'; // Ubah status jadi sukses
    $order->save();

    return response()->json(['message' => 'Status pembayaran berhasil diperbarui menjadi sukses']);
}
}

