<!-- resources/views/payment/index.blade.php -->

@extends('backend.v_layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Checkout Pembayaran</h1>
    
    <form action="{{ route('backend.payment.charge') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Order ID</label>
            <input type="text" class="form-control" name="order_id" id="order_id" required placeholder="Masukkan Order ID">
        </div>
        
        <div class="mb-3">
            <label for="total_biaya" class="form-label">Total Biaya</label>
            <input type="number" class="form-control" name="total_biaya" id="total_biaya" required placeholder="Masukkan Total Biaya" min="1">
        </div>

        <div class="mb-3">
            <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
            <input type="text" class="form-control" name="nama_penyewa" id="nama_penyewa" required placeholder="Masukkan Nama Penyewa">
        </div>

        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
    </form>
</div>
@endsection
{{-- 
@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h1>Halaman Pembayaran</h1>
    <p>Nama Penyewa: {{ $penyewa->nama_penyewa }}</p>
    <p>Lapangan: {{ $penyewa->lapangan->nama_lapangan ?? 'N/A' }}</p>
    <p>Total Biaya: Rp {{ number_format($penyewa->total_biaya, 2, ',', '.') }}</p>

    <!-- Form to process the payment -->
    <form action="{{ route('backend.payment.process', $penyewa->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Lanjutkan Pembayaran</button>
    </form>
</div>
@endsection --}}


