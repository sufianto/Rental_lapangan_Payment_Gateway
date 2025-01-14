@extends('backend.v_layouts.app')

@section('content')




<div class="row">
    <div class="col-12">
       
        <div class="card">
           
            <div class="card-body">
                <h5 class="card-title">Daftar Penyewa</h5>
                <p>Jam operasional: 08:00 - 22:00</p>
                <a href="{{ route('backend.penyewa.create') }}">
                    <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                </a>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Order</th>
                                <th>Nama Penyewa</th>
                                <th>Lapangan</th>
                                <th>Biaya lapangan</th>
                                <th>Jumlah Pesan</th>
                                <th>Jam Bermain</th>
                                <th>jam Selesai</th>
                                <th>Total Jam</th>
                                <th>Total Biaya</th>
                                <th>Status</th>
                                @if(Auth::user()->role == '0' || Auth::user()->role == '1')
                                <th>Aksi</th>
                                @endif
                                <th>Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penyewa as $penyewa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penyewa->order_id }}</td>
                                <td>{{ $penyewa->nama_penyewa }}</td>
                                <td>{{ $penyewa->lapangan->nama_lapangan ?? '-' }}</td>
                                <td>{{ $penyewa->biaya_lapangan }} /jam</td>
                                <td>{{ $penyewa->stok_lapangan }} lapangan</td>
                                <td>{{ \Carbon\Carbon::parse($penyewa->mulai_sewa)->format('H:i') }}  </td>
                                <td>{{ \Carbon\Carbon::parse($penyewa->akhir_sewa)->format('H:i') }} </td>
                                <td>{{ $penyewa->total_jam }} jam</td>
                                <td>Rp {{ number_format($penyewa->total_biaya, 2, ',', '.') }}</td>
                                <td>
                                    @if ($penyewa->status_bayar == 1)
                                        <span class="badge badge-success"></i>
                                            success</span>
                                    @elseif($penyewa->status_bayar == 0)
                                        <span class="badge badge-secondary"></i>
                                            pending</span>
                                        @elseif($penyewa->status_bayar == 2)
                                        <span class="badge badge-danger"></i>
                                            gagal</span>
                                    @endif
                                </td>
                                {{-- <td>{{ $penyewa->payment_status }}</td> --}}
                                
                                    @if(Auth::user()->role == '0' || Auth::user()->role == '1')
                                    <td>
                                        <a href="{{ route('backend.penyewa.edit', $penyewa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('backend.penyewa.destroy', $penyewa->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                        @endif
                                        
                                    {{-- @if(Auth::user()->role == '2' && $penyewa->user_id == Auth::id())
                                        <a href="{{ route('backend.penyewa.edit', $penyewa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('backend.penyewa.destroy', $penyewa->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    @endif --}}
                                    <!-- Redirect to payment page (create) -->
                                    {{-- <a href="{{ route('backend.payment.charge', ['penyewa_id' => $penyewa->id]) }}" method="POST" class="btn btn-primary btn-sm">Bayar Sekarang</a> --}}
                                     
                               
                               
                                <td>
                                    @if ($penyewa->status_bayar == 1)
                                    <a href="{{ route('backend.v_penyewa.struk', $penyewa->order_id) }}" class="btn btn-info btn-sm" target="_blank">
                                        Cetak Struk
                                    </a>
                                @elseif($penyewa->status_bayar == 0)
                                <form action="{{ route('backend.penyewa.charge', ['order_id' => $penyewa->order_id]) }}" method="POST" >
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-primary btn-sm ">Bayar Sekarang</button>
                                </form>
                                    @elseif($penyewa->status_bayar == 2)
                                    <button type="submit" class="btn btn-primary btn-sm ">Bayar Sekarang</button>
                                @endif
                                    
                                   
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13">Tidak ada penyewa yang ditemukan</td>
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
