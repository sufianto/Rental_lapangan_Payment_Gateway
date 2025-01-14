@extends('backend.v_layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('backend.lapangan.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title"> {{ $judul }} </h4>
                         <!-- Gambar Lapangan -->
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>Gambar Lapangan</label>
                                @if ($edit->foto)
                                <img src="{{ asset('storage/img-lapangan/' . $edit->foto) }}" 
                                    class="img-thumbnail foto-preview" width="100%">
                                @else
                                <img src="{{ asset('storage/img-lapangan/default.jpg') }}" 
                                    class="img-thumbnail foto-preview" width="100%">
                                @endif
                                <p></p>
                                <input type="file" name="foto" 
                                    class="form-control @error('foto') is-invalid @enderror" 
                                    onchange="previewFoto()">
                                @error('foto')
                                <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                             
                            <!-- Nama Lapangan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lapangan</label>
                                    <input type="text" name="nama_lapangan" 
                                        value="{{ old('nama_lapangan', $edit->nama_lapangan) }}" 
                                        class="form-control @error('nama_lapangan') is-invalid @enderror" 
                                        placeholder="Masukkan Nama Lapangan">
                                    @error('nama_lapangan')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                          
                            <!-- Kelas Lapangan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelas Lapangan</label>
                                    <select name="kelas_lapangan" 
                                        class="form-control @error('kelas_lapangan') is-invalid @enderror">
                                        <option value="" selected> - Pilih Kelas Lapangan - </option>
                                        @foreach ($biaya as $row)
                                        <option value="{{ $row->kelas_lapangan }}" 
                                            {{ old('kelas_lapangan', $edit->kelas_lapangan) == $row->kelas_lapangan ? 'selected' : '' }}>
                                            {{ $row->kelas_lapangan }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_lapangan')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <!-- Stok (Read-only) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" 
                                        value="{{ $edit->biaya ? $edit->biaya->stok_lapangan : '0' }}" 
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <!-- Harga (Read-only) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" 
                                        value="{{ $edit->biaya ? number_format($edit->biaya->biaya_lapangan, 2, ',', '.') : '0' }}" 
                                        class="form-control" readonly>
                                </div>
                            </div> --}}
                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="" 
                                            {{ old('status', $edit->status) == '' ? 'selected' : '' }}> - Pilih Status -</option>
                                        <option value="1" 
                                            {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="0" 
                                            {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Tidak Tersedia</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Detail -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" rows="4">{{ old('detail', $edit->detail) }}</textarea>
                                    @error('detail')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('backend.lapangan.index') }}">
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
