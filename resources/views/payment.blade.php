@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl p-6 max-w-3xl w-full">
        <h3 class="text-xl font-semibold mb-6 text-gray-800">Detail Produk</h3>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 border-b">Nama Produk</th>
                        <th class="p-3 border-b text-center">Jumlah</th>
                        <th class="p-3 border-b text-right">Harga</th>
                        <th class="p-3 border-b text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">{{ $item->product_name }}</td>
                            <td class="p-3 text-center">{{ $item->quantity }}</td>
                            <td class="p-3 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="p-3 text-right">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Rincian Biaya -->
        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
            <h4 class="text-lg font-semibold text-gray-700 mb-4">Rincian Biaya</h4>
            <div class="space-y-2 text-gray-700">
                <div class="flex justify-between">
                    <span>Total Pesanan</span>
                    <span>Rp {{ number_format($paymentDetails['total_order'], 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Biaya Layanan</span>
                    <span>Rp {{ number_format($paymentDetails['fee_platform'], 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-gray-900 border-t pt-2">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($paymentDetails['total_bayar'], 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <h2 class="text-center text-2xl font-bold text-gray-800 my-8">Pembayaran</h2>

        @if(isset($order))
            <p class="text-center text-lg text-gray-600">Total Pembayaran:</p>
            <p class="text-center text-3xl font-bold text-green-600 mb-6">
                Rp {{ number_format($paymentDetails['total_bayar'], 0, ',', '.') }}
            </p>

            <div class="text-center space-y-4">
                <!-- Tombol Bayar -->
                <button id="pay-button" 
                    class="w-full px-6 py-3 bg-green-500 text-white text-lg font-semibold rounded-xl shadow-md transition duration-300 hover:bg-green-600 hover:scale-[1.02]">
                    Bayar Sekarang
                </button>

                <!-- Tombol Kembali ke Keranjang -->
                <a href="/chart" 
                    class="block w-full px-6 py-3 bg-gray-400 text-white text-lg font-semibold rounded-xl shadow-md transition duration-300 hover:bg-gray-500 hover:scale-[1.02] text-center">
                    Kembali ke Keranjang
                </a>
            </div>
        @else
            <p class="text-red-500 text-center text-lg mt-6">⚠️ Terjadi kesalahan, pesanan tidak ditemukan.</p>
        @endif
    </div>
</div>

@if(isset($snapToken))
    {{-- Midtrans Snap --}}
    <script 
        src="https://app.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "/payment/success?order_id=" + result.order_id;
                },
                onPending: function(result) {
                    console.log("Transaksi pending", result);
                },
                onError: function(result) {
                    console.error("Error pembayaran:", result);
                    alert("Terjadi kesalahan pada pembayaran.");
                },
                onClose: function() {
                    if (confirm("Kamu menutup popup pembayaran. Ingin kembali ke keranjang?")) {
                        window.location.href = "/chart";
                    }
                }
            });
        });
    </script>
@endif
@endsection
