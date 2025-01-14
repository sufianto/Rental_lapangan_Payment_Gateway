@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('backend.biaya.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="form-group">
                                <label for="kelas_lapangan">Kelas Lapangan</label>
                                <input type="text" name="kelas_lapangan" value="{{ old('kelas_lapangan') }}"
                                    class="form-control @error('kelas_lapangan') is-invalid @enderror"
                                    placeholder="Masukkan Kelas Lapangan">
                                @error('kelas_lapangan')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="biaya_lapangan">Biaya Lapangan</label>
                                <input type="number" name="biaya_lapangan" value="{{ old('biaya_lapangan') }}"
                                    class="form-control @error('biaya_lapangan') is-invalid @enderror"
                                    placeholder="Masukkan Biaya Lapangan">
                                @error('biaya_lapangan')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stok_lapangan">Stok Lapangan</label>
                                <input type="number" name="stok_lapangan" value="{{ old('stok_lapangan') }}"
                                    class="form-control @error('stok_lapangan') is-invalid @enderror"
                                    placeholder="Masukkan Stok Lapangan">
                                @error('stok_lapangan')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('backend.biaya.index') }}">
                                    <button type="button" class="btn btn-secondary">Kembali</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
