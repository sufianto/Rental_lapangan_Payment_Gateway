@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.biaya.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>  <form action="{{ route('backend.biaya.resetStok') }}" method="POST">
                        @csrf
                        {{-- <button type="submit">Reset Stok</button> --}}
                    </form>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas Lapangan</th>
                                    <th>Biaya Lapangan</th>
                                    <th>Tersesia Lapamgam</th>
                                    <th>Total lapangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->kelas_lapangan }}</td>
                                        <td>{{ $row->biaya_lapangan }}</td>
                                        <td>{{ $row->stok_lapangan }}</td>
                                        <td>{{ $row->stok_awal }}</td>
                                        <td>
                                            <a href="{{ route('backend.biaya.edit', $row->id) }}" title="Ubah Data">
                                                <button type="button" class="btn btn-cyan btn-sm">
                                                    <i class="far fa-edit"></i> Ubah
                                                </button>
                                            </a>
                                            @if(Auth::user()->role == '1' )
                                            <form method="POST" action="{{ route('backend.biaya.destroy', $row->id) }}" style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="{{ $row->kelas_lapangan }}" title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
