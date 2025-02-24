@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex justify-center items-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white shadow-lg rounded-xl p-6 print-area border-t-4 border-blue-500">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-800">Struk Pembayaran</h2>
            <p class="text-sm text-gray-500">Terima kasih atas pembelian Anda!</p>
        </div>
        
        <div class="mt-6 text-gray-700">
            <div class="flex justify-between border-b py-2">
                <span class="font-semibold">Order ID:</span>
                <span>{{ $order->order_id }}</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-semibold">Nama:</span>
                <span>{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-semibold">No. Telepon:</span>
                <span>{{ $order->customer_phone }}</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-semibold">Catatan:</span>
                <span>{{ $order->notes ?? '-' }}</span>
            </div>
            <div class="flex justify-between border-b py-2 text-lg font-bold">
                <span>Total Bayar:</span>
                <span class="text-blue-600">Rp {{ number_format($order->total_price, 2, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="font-semibold">Status:</span>
                <span class="text-green-600 font-bold">{{ $order->status }}</span>
            </div>
        </div>
        
        <div class="text-center mt-6 no-print flex flex-col md:flex-row items-center justify-center space-y-2 md:space-y-0 md:space-x-2">
            <button onclick="printReceipt()" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                Cetak Struk
            </button>
            <a href="{{ route('home') }}" class="w-full md:w-auto px-6 py-3 bg-gray-500 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-gray-600 transition">
                Back to Home
            </a>
            <a href="{{ route('order.receipt.pdf', ['order_id' => $order->id]) }}" class="w-full md:w-auto px-6 py-3 bg-green-500 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                Download PDF
            </a>
        </div>
    </div>
</div>

<style>
/* CSS untuk mode cetak */
@media print {
    body * {
        visibility: hidden;
    }
    .print-area, .print-area * {
        visibility: visible;
    }
    .print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .no-print {
        display: none;
    }
}
</style>

<script>
function printReceipt() {
    window.print();
}
</script>

@endsection
