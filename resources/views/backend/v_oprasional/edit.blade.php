@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Edit Jam Operasional</h1>
    <form action="{{ route('backen.v_oprasional.update', $stokLapangan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilihan Kelas Lapangan -->
        <div class="mb-3">
            <label for="biaya_id" class="form-label">Kelas Lapangan:</label>
            <select name="biaya_id" id="biaya_id" class="form-control" required>
                @foreach($biaya as $b)
                <option value="{{ $b->id }}" {{ $stokLapangan->biaya_id == $b->id ? 'selected' : '' }}>
                    {{ $b->kelas_lapangan }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Input Tanggal Sewa -->
        <div class="mb-3">
            <label for="tanggal_sewa" class="form-label">Tanggal Sewa:</label>
            <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" value="{{ $stokLapangan->tanggal_sewa }}" required>
        </div>

        <!-- Input Waktu Mulai Sewa -->
        <div class="mb-3">
            <label for="mulai_sewa" class="form-label">Mulai Sewa:</label>
            <input type="time" name="mulai_sewa" id="mulai_sewa" class="form-control" value="{{ \Carbon\Carbon::parse($stokLapangan->mulai_sewa)->format('H:i') }}" required>
        </div>

        <!-- Input Waktu Akhir Sewa -->
        <div class="mb-3">
            <label for="akhir_sewa" class="form-label">Akhir Sewa:</label>
            <input type="time" name="akhir_sewa" id="akhir_sewa" class="form-control" value="{{ \Carbon\Carbon::parse($stokLapangan->akhir_sewa)->format('H:i') }}" required>
        </div>

        <!-- Input Stok Lapangan -->
        <div class="mb-3">
            <label for="stok_tersedia" class="form-label">Stok Lapangan:</label>
            <input type="number" name="stok_tersedia" id="stok_tersedia" class="form-control" value="{{ $stokLapangan->stok_tersedia }}" min="0" required>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('backend.v_oprasional.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
