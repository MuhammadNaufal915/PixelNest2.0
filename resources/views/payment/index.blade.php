@extends('layouts.app')
@section('title', 'Payment')
@section('content')
<div style="max-width:600px;margin:4rem auto;text-align:center">
    <h1>Complete Your Payment</h1>
    <p style="color:var(--gray);margin:1rem 0">Order: {{ $order->order_number }}</p>
    <p style="font-size:2rem;font-weight:700;color:var(--primary);margin:2rem 0">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
    <button id="pay-button" class="btn btn-primary" style="padding:1.5rem 3rem;font-size:1.2rem">Pay Now</button>
</div>
@endsection
@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.getElementById('pay-button').addEventListener('click', function(){
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = '{{ route("payment.finish") }}?order_id={{ $order->order_number }}';
        },
        onPending: function(result){
            window.location.href = '{{ route("payment.finish") }}?order_id={{ $order->order_number }}';
        },
        onError: function(result){
            alert('Payment failed!');
        }
    });
});
</script>
@endsection
