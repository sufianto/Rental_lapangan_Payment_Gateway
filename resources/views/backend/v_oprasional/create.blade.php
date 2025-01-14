@extends('backend.v_layouts.app')


@section('content')
<div class="container">
    <h1>Tambah Jam Operasional</h1>
    <form action="{{ route('backend.v_oprasional.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="biaya_id">Kelas Lapangan</label>
            <select name="biaya_id" id="biaya_id" class="form-control" required>
                @foreach($biaya as $item)
                    <option value="{{ $item->id }}">{{ $item->kelas_lapangan }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_sewa">Tanggal Sewa</label>
            <input type="date" name="tanggal_sewa" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="mulai_sewa">Mulai Sewa</label>
            <input type="time" name="mulai_sewa" class="form-control" required>
        </div>

        {{-- <div class="form-group">
            <label for="akhir_sewa">Akhir Sewa</label>
            <input type="time" name="akhir_sewa" class="form-control" required>
        </div> --}}

        <div class="form-group">
            <label for="stok_tersedia">Stok Tersedia</label>
            <input type="number" name="stok_tersedia" class="form-control" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
