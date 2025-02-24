@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 pt-28 pb-auto">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-gray-800">Keranjang Belanja</h2>
        <div class="w-24 h-1 mx-auto bg-green-500 rounded-full mt-2"></div>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="grid gap-6 max-w-4xl mx-auto">
            @php
                $total = 0;
            @endphp

            @foreach(session('cart') as $id => $item)
                @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp

                <div class="flex flex-col sm:flex-row items-center justify-between p-4 bg-white shadow-md rounded-lg border border-gray-200">
                    <img src="{{ asset($item['image']) }}" class="w-24 h-24 object-cover rounded-lg border border-gray-300">
                    <div class="flex-1 text-center sm:text-left px-4">
                        <p class="font-semibold text-lg text-gray-800">{{ $item['name'] }}</p>
                        <p class="text-green-600 font-bold text-lg">Rp {{ number_format($item['price'], 2, ',', '.') }}</p>
                        <p class="text-gray-600 text-sm">Subtotal: Rp {{ number_format($subtotal, 2, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Form untuk mengubah jumlah item -->
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                class="w-16 p-2 border rounded-lg text-center bg-gray-100">
                            <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Ubah</button>
                        </form>
                        
                        <!-- Tombol hapus item -->
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total Harga -->
        <div class="max-w-4xl mx-auto text-right mt-6 text-xl font-semibold text-gray-800">
            Total Harga: <span class="text-green-600">Rp {{ number_format($total, 2, ',', '.') }}</span>
        </div>

        <!-- Form Checkout -->
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Detail Pemesanan</h3>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-500" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-4">
                    <label for="phone" class="block font-medium text-gray-700">No. Telepon</label>
                    <input type="tel" id="phone" name="phone" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-500"
                        pattern="[0-9]+" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>

                <!-- Catatan Pesanan -->
                <div class="mb-4">
                    <label for="notes" class="block font-medium text-gray-700">Catatan Pesanan</label>
                    <textarea id="notes" name="notes" rows="3" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-500" required></textarea>
                </div>

                <!-- Tombol Checkout -->
                <button type="submit" class="w-full bg-green-500 text-white py-3 text-lg font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                    Checkout Sekarang
                </button>
            </form>
        </div>
    @else
        <div class="text-center py-10">
            <p class="text-gray-600 text-lg">Keranjang Anda masih kosong.</p>
            <a href="/" class="mt-4 inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">Lihat Menu</a>
        </div>
    @endif
</div>

@endsection
