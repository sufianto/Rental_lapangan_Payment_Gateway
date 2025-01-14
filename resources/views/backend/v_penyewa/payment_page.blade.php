{{-- resources/views/backend/v_payment/payment_page.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    @extends('backend.v_layouts.app')

    @section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Checkout Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Order ID:</strong> {{ $penyewa->order_id }}</p>
                        <p><strong>Nama Penyewa:</strong> {{ $penyewa->nama_penyewa }}</p>
                        <p><strong>Total Biaya:</strong> Rp {{ number_format($penyewa->total_biaya, 2, ',', '.') }}</p>
                        
                        <button id="pay-button" class="btn btn-success w-100 mt-3" onclick="payNow()">Bayar Sekarang</button> 
                        <a href="{{ route('backend.penyewa.index') }}" class="btn btn-secondary w-100 mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    {{-- <script type="text/javascript">
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
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
       function payNow() {
    snap.pay("{{ $snapToken }}", {
        onSuccess: function(result) {
            alert("Pembayaran Berhasil!");
            updatePaymentStatus(result.order_id, 'success');
        },
        onPending: function(result) {
            alert("Pembayaran Pending.");
            updatePaymentStatus(result.order_id, 'pending');
        },
        onError: function(result) {
            alert("Pembayaran Gagal.");
            updatePaymentStatus(result.order_id, 'failed');
        }
    });
}

function updatePaymentStatus(orderId, status) {
    axios.post("{{ route('backend.penyewa.updateStatus') }}", {
        order_id: orderId,
        status: status
    })
    .then(response => {
        if (response.data.success) {
            alert("Status pembayaran berhasil diperbarui!");

            // Jika redirect true, arahkan ke halaman index
            window.location.href = "{{ route('backend.penyewa.index') }}"; // Redirect ke halaman daftar penyewa setelah pembaruan
        } else {
            alert("Gagal memperbarui status pembayaran.");
        }
    })
    .catch(error => {
        console.error(error);
        alert("Terjadi kesalahan saat memperbarui status pembayaran.");
    });
}

    </script>
</body>
</html>
