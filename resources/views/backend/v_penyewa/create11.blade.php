<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <style>
    .btn-primary:hover {
    background-color: #0056b3;
    transition: background-color 0.3s ease;
}

 </style>


</head>
<body>
    @extends('backend.v_layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-calendar-plus me-2"></i> Tambah Penyewa 
                    </h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('backend.penyewa.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="nama_penyewa" class="form-label">
                                <i class="fas fa-user me-2"></i> Nama Penyewa
                            </label>
                            <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" required>
                        </div>

                        <div class="mb-3">
                            <label for="lapangan_id" class="form-label">
                                <i class="fas fa-futbol me-2"></i> Pilih Lapangan
                            </label>
                            <select class="form-control" id="lapangan_id" name="lapangan_id" required>
                                <option value="" selected disabled>Pilih Lapangan</option>
                                @foreach($lapangans as $l)
                                    <option value="{{ $l->id }}">{{ $l->nama_lapangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="mulai_sewa" class="form-label">
                                <i class="fas fa-clock me-2"></i> Mulai Sewa
                            </label>
                            <input type="datetime-local" class="form-control" id="mulai_sewa" name="mulai_sewa" required>
                        </div>

                        <div class="mb-3">
                            <label for="akhir_sewa" class="form-label">
                                <i class="fas fa-clock me-2"></i> Akhir Sewa
                            </label>
                            <input type="datetime-local" class="form-control" id="akhir_sewa" name="akhir_sewa" required>
                        </div>

                        <div class="mb-3">
                            <label for="stok_lapangan" class="form-label">
                                <i class="fas fa-database me-2"></i> Jumlah Stok Lapangan
                            </label>
                            <input type="number" class="form-control" id="stok_lapangan" name="stok_lapangan" min="1" required>
                            @error('stok_lapangan')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_jam" class="form-label">
                                <i class="fas fa-hourglass-half me-2"></i> Total Jam
                            </label>
                            <input type="text" class="form-control" id="total_jam" name="total_jam" readonly>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Simpan
                            </button>
                            <a href="{{ route('backend.penyewa.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mulaiSewa = document.getElementById('mulai_sewa');
        const akhirSewa = document.getElementById('akhir_sewa');
        const totalJam = document.getElementById('total_jam');

        function hitungTotalJam() {
            const mulai = new Date(mulaiSewa.value);
            const akhir = new Date(akhirSewa.value);

            if (mulai && akhir && akhir > mulai) {
                const diffHours = Math.abs(akhir - mulai) / 36e5; // Selisih dalam jam
                totalJam.value = diffHours.toFixed(2); // Tampilkan 2 desimal
            } else {
                totalJam.value = 0;
            }
        }

        mulaiSewa.addEventListener('change', hitungTotalJam);
        akhirSewa.addEventListener('change', hitungTotalJam);
    });
</script>
@endsection

</body>
</html>