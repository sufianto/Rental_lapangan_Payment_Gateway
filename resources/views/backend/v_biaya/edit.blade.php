@extends('backend.v_layouts.app')
@section('content')
    <div class="container">
        <h2>{{ $judul }}</h2>

        <!-- Jika ada error, tampilkan pesan error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Edit Biaya -->
        <form action="{{ route('backend.biaya.update', $edit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kelas_lapangan">Kelas Lapangan</label>
                <input type="text" class="form-control" id="kelas_lapangan" name="kelas_lapangan" value="{{ old('kelas_lapangan', $edit->kelas_lapangan) }}" required>
            </div>

            <div class="form-group">
                <label for="biaya_lapangan">Biaya Lapangan</label>
                <input type="number" class="form-control" id="biaya_lapangan" name="biaya_lapangan" value="{{ old('biaya_lapangan', $edit->biaya_lapangan) }}" required>
            </div>

            <div class="form-group">
                <label for="stok_lapangan">Stok Lapangan</label>
                <input type="number" class="form-control" id="stok_lapangan" name="stok_lapangan" value="{{ old('stok_lapangan', $edit->stok_lapangan) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection