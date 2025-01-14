@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Error</strong>     {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
    @endif
    <h1>Tambah Penyewa </h1>
    <p>Jam operasional: 08:00 - 22:00</p>
    <form action="{{ route('backend.penyewa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
            <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" required>
        </div>

        <div class="mb-3">
            <label for="lapangan_id" class="form-label">Lapangan</label>
            <select class="form-control" id="lapangan_id" name="lapangan_id" required>
                @foreach($lapangans as $l)
                <option value="{{ $l->id }}">{{ $l->nama_lapangan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mulai_sewa" class="form-label">Mulai Sewa</label>
            <input type="datetime-local" class="form-control" id="mulai_sewa" name="mulai_sewa" required>
        </div>

        <div class="mb-3">
            <label for="akhir_sewa" class="form-label">Akhir Sewa</label>
            <input type="datetime-local" class="form-control" id="akhir_sewa" name="akhir_sewa" required>
        </div>

        <div class="mb-3">
            <label for="stok_lapangan" class="form-label">Jumlah Pesan</label>
            <input type="number" class="form-control" id="stok_lapangan" name="stok_lapangan" min="1" required>
            @error('stok_lapangan')
            <span class="invalid-feedback alert-danger" role="alert">
                {{ $message }}
            </span>
        @enderror
        </div>

        <div class="mb-3">
            <label for="total_jam" class="form-label">Total Jam</label>
            <input type="text" class="form-control" id="total_jam" name="total_jam" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.penyewa.index') }}" class="btn btn-secondary ">Kembali</a>
    </form>
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