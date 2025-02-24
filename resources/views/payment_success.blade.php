@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 pt-28 pb-auto text-center">
    <h2 class="text-3xl font-bold text-green-600">Pembayaran Berhasil!</h2>
    <p class="text-gray-600 mt-2">Terima kasih! Pesanan Anda telah kami terima.</p>
    
    @if(isset($order))
        <p class="text-gray-600 mt-2"><strong>Order ID:</strong> {{ $order->order_id }}</p>
        <p class="text-gray-600 mt-2"><strong>Total Bayar:</strong> Rp {{ number_format($order->total_price, 2, ',', '.') }}</p>

        <a href="{{ route('order.receipt', ['order_id' => $order->id]) }}" class="mt-4 inline-block px-6 py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">
            Cetak Struk
        </a>
    @endif

    <a href="/" class="mt-6 inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
        Kembali ke Menu
    </a>
</div>
@endsection
