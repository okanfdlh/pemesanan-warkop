@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 pt-28 pb-auto text-center">
    <h2 class="text-3xl font-bold text-gray-800">Pembayaran</h2>
    <p class="text-gray-600 mt-2">Silakan lakukan pembayaran terlebih dahulu.</p>

    <button id="pay-button" class="mt-6 px-6 py-3 bg-green-500 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
        Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "{{ route('payment.success') }}";
            },
            onPending: function(result) {
                alert('Pembayaran pending.');
            },
            onError: function(result) {
                alert('Pembayaran gagal.');
            }
        });
    };
</script>
@endsection
