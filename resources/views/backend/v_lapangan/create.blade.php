@extends('backend.v_layouts.app')

@section('content')
{{-- <div class="container">
    <h1>{{ $judul }}</h1>

    <form action="{{ route('backend.lapangan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            
        </div>
        <div class="col-md-6">
              
            </div>
            <div class="col-md-6">
                
            </div>
        <div class="mb-3">
           
        </div>

        <div class="mb-3">
            
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.lapangan.index') }}" class="btn btn-secondary ">Kembali</a>
    </form>
</div> --}}

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" action="{{ route('backend.lapangan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul }}</h4>
                        <div class="form-group">
                            <label for="nama_lapangan" class="form-label">Nama Lapangan</label>
                            <input type="text" name="nama_lapangan" id="nama_lapangan" class="form-control @error('nama_lapangan') is-invalid @enderror" value="{{ old('nama_lapangan') }}" required>
                            @error('nama_lapangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kelas_lapangan" class="form-label">Kelas Lapangan</label>
                            <select name="kelas_lapangan" id="kelas_lapangan" class="form-control @error('kelas_lapangan') is-invalid @enderror" required>
                                <option value="">-- Pilih Kelas Lapangan --</option>
                                @foreach ($biaya as $item)
                                    <option value="{{ $item->kelas_lapangan }}" {{ old('kelas_lapangan') == $item->kelas_lapangan ? 'selected' : '' }}>
                                        {{ $item->kelas_lapangan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_lapangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="detail" class="form-label">Detail Lapangan</label>
            <textarea name="detail" id="detail" rows="5" class="form-control @error('detail') is-invalid @enderror" required>{{ old('detail') }}</textarea>
            @error('detail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
                        </div>
                        <label for="foto" class="form-label">Foto Lapangan</label>
            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" required>
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
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
@endsection