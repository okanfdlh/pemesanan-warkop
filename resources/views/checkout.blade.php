@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-center text-2xl font-bold mb-4">Pembayaran</h2>
    <p class="text-center">Total Pembayaran: <strong>Rp {{ number_format($order->total_price, 2, ',', '.') }}</strong></p>

    <div class="text-center mt-6">
        <button id="pay-button" class="px-6 py-3 bg-green-500 text-white text-lg font-semibold rounded-lg hover:bg-green-600">
            Bayar Sekarang
        </button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                window.location.href = "/payment/success?order_id=" + result.order_id;
            },
            onPending: function(result) {
                alert('Pembayaran tertunda! Silakan selesaikan pembayaran.');
                console.log(result);
            },
            onError: function(result) {
                alert('Pembayaran gagal! Silakan coba lagi.');
                console.log(result);
            }
        });
    };
    </script>
@endsection
