@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-4">Pembayaran</h2>

        @if(isset($order))
            <p class="text-center text-lg text-gray-700">Total Pembayaran:</p>
            <p class="text-center text-3xl font-semibold text-green-600 mb-6">
                Rp {{ number_format($order->total_price, 2, ',', '.') }}
            </p>

            <div class="text-center space-y-4">
                <!-- Tombol Bayar -->
                <button id="pay-button" 
                    class="w-full px-6 py-3 bg-green-500 text-white text-lg font-semibold rounded-lg shadow-md transition duration-300 transform hover:bg-green-600 hover:scale-105">
                    Bayar Sekarang
                </button>

                <!-- Tombol Kembali ke Keranjang -->
                <a href="/cart" 
                    class="block w-full px-6 py-3 bg-gray-400 text-white text-lg font-semibold rounded-lg shadow-md transition duration-300 transform hover:bg-gray-500 hover:scale-105 text-center">
                    Kembali ke Keranjang
                </a>
            </div>
        @else
            <p class="text-red-500 text-center text-lg">Terjadi kesalahan, pesanan tidak ditemukan.</p>
        @endif
    </div>
</div>

@if(isset($snapToken))
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "/payment/success?order_id=" + result.order_id;
            }
        });
    };
    </script>
@endif
@endsection
