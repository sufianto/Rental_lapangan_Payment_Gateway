@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h1>Edit Penyewa</h1>
    <form action="{{ route('backend.penyewa.update', $penyewa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
            <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" value="{{ $penyewa->nama_penyewa }}" required>
        </div>

        <div class="mb-3">
            <label for="lapangan_id" class="form-label">Lapangan</label>
            <select class="form-control" id="lapangan_id" name="lapangan_id" required>
                @foreach($lapangans as $lapangan)
                <option value="{{ $lapangan->id }}" {{ $penyewa->lapangan_id == $lapangan->id ? 'selected' : '' }}>
                    {{ $lapangan->nama_lapangan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="stok_lapangan" class="form-label">Stok Lapangan</label>
            <input type="number" class="form-control" id="stok_lapangan" name="stok_lapangan" value="{{ $penyewa->stok_lapangan }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="mulai_sewa" class="form-label">Mulai Sewa</label>
            <input type="datetime-local" class="form-control" id="mulai_sewa" name="mulai_sewa" value="{{ $penyewa->mulai_sewa->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="akhir_sewa" class="form-label">Akhir Sewa</label>
            <input type="datetime-local" class="form-control" id="akhir_sewa" name="akhir_sewa" value="{{ $penyewa->akhir_sewa->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status_bayar" class="form-control
@error('status_bayar') is-invalid @enderror">
                <option value=""
                    {{ old('status_bayar', $penyewa->status_bayar) == '' ? 'selected' : '' }}> -
                    Pilih status -</option>
                <option value="1"
                    {{ old('status_bayar', $penyewa->status_bayar) == '1' ? 'selected' : '' }}>
                    success</option>
               
                    <option value="0"
                    {{ old('status_bayar', $penyewa->status_bayar) == '0' ? 'selected' : '' }}>
                    pending</option>
                    <option value="2"
                    {{ old('status_bayar', $penyewa->status_bayar) == '2' ? 'selected' : '' }}>
                    gagal</option>
            </select>
            @error('payment_status')
                <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
