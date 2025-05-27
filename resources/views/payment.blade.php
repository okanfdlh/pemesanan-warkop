@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 max-w-3xl w-full">
        <h3 class="text-lg font-semibold mb-4">Detail Produk</h3>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 text-sm text-left md:table block">
                <thead class="bg-gray-100 md:table-header-group hidden md:table">
                    <tr class="md:table-row block text-gray-700">
                        <th class="border border-gray-300 p-2 md:table-cell block">Nama Produk</th>
                        <th class="border border-gray-300 p-2 md:table-cell block">Jumlah</th>
                        <th class="border border-gray-300 p-2 md:table-cell block">Harga</th>
                        <th class="border border-gray-300 p-2 md:table-cell block">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="md:table-row-group block">
                    @foreach ($order->orderItems as $item)
                        <tr class="md:table-row block mb-4 border border-gray-300 md:border-0 rounded-md md:rounded-none">
                            <td class="p-2 border border-gray-300 md:table-cell block before:content-['Nama_Produk:'] before:font-semibold before:block md:before:hidden">
                                {{ $item->product_name }}
                            </td>
                            <td class="p-2 border border-gray-300 md:table-cell block before:content-['Jumlah:'] before:font-semibold before:block md:before:hidden">
                                {{ $item->quantity }}
                            </td>
                            <td class="p-2 border border-gray-300 md:table-cell block before:content-['Harga:'] before:font-semibold before:block md:before:hidden">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="p-2 border border-gray-300 md:table-cell block before:content-['Subtotal:'] before:font-semibold before:block md:before:hidden">
                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-800 my-6">Pembayaran</h2>

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
                <a href="/chart" 
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
