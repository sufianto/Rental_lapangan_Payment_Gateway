@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->
<div class="row">
    <div class="col-12">
        <a href="{{ route('backend.lapangan.create') }}">
            <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
        </a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> {{ $judul }} </h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lapangan</th>
                                <th>Kelas Lapangan</th>
                                <th>Stok</th>
                                <th>Total Stok</th>
                               
                                <th>Biaya</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($index as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_lapangan }}</td>
                        <td>{{ $item->kelas_lapangan }}</td>
                        <td>{{ $item->stok_lapangan  }}</td>
                        <td>{{ $item->stok_awal }}</td>
                        <td>Rp {{ number_format($item->biaya_lapangan, 2, ',', '.') }}</td>
                        <td>
                            @if ($item->status)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            
                            @if(Auth::user()->role == '1' )
                            <a href="{{ route('backend.lapangan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('backend.lapangan.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                            @endif
                            {{-- <a href="{{ route('backend.lapangan.jadwal', $item->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                            {{-- @foreach ($penyewa as $item)
                            <a href="{{ route('backend.penyewa.jadwal', ['lapangan_id' => $item->lapangan->id]) }}" class="btn btn-info">Lihat Jadwal</a>
                        @endforeach --}}
                        <a href="{{ route('backend.lapangan.show', $item->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                        
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data lapangan tidak ditemukan</td>
                    </tr>
                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection
