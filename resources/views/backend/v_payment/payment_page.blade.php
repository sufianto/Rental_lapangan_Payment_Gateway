{{-- resources/views/backend/v_payment/payment_page.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    @extends('backend.v_layouts.app')

@section('content')
    <h1>Checkout Pembayaran</h1>

    <form id="payment-form">
        <button type="button" id="pay-button" onclick="payNow()">Bayar Sekarang</button>
    </form>
    @endsection
    <script type="text/javascript">
        function payNow() {
            // Menggunakan snap token yang dikirimkan ke view
            snap.pay("{{ $snapToken }}", {
                onSuccess: function(result){
                    alert("Pembayaran Berhasil: " + JSON.stringify(result));
                },
                onPending: function(result){
                    alert("Pembayaran Pending: " + JSON.stringify(result));
                },
                onError: function(result){
                    alert("Pembayaran Gagal: " + JSON.stringify(result));
                }
            });
        }
    </script>
</body>
</html>
