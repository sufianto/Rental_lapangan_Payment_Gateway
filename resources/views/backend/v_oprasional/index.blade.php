@extends('backend.v_layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Operasional</h5>
                    <p>Jam operasional: 08:00 - 22:00</p>

                    <form method="GET" action="{{ route('backend.v_oprasional.index') }}">
                        <button type="submit" class="btn btn-primary mt-2">Cari</button>
                        <button type="button" class="btn btn-secondary mt-2" id="resetButton">Reset</button>
                        <!-- Tombol Reset dengan JS -->

                        <div class="row">
                            <div class="col">
                                <label for="kelas_lapangan">Kelas Lapangan</label>
                                <select class="form-control" name="kelas_lapangan">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelasLapangans as $kelas)
                                        <option value="{{ $kelas }}"
                                            {{ request('kelas_lapangan') == $kelas ? 'selected' : '' }}>{{ $kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="tanggal_sewa">Tanggal Sewa</label>
                                <input type="date" class="form-control" name="tanggal_sewa"
                                    value="{{ request('tanggal_sewa') }}">
                            </div>
                            <div class="col">
                                <label for="mulai_sewa">Mulai Sewa</label>
                                <input type="time" class="form-control" name="mulai_sewa"
                                    value="{{ request('mulai_sewa') }}">
                            </div>
                            <div class="col">
                                <label for="akhir_sewa">Akhir Sewa</label>
                                <input type="time" class="form-control" name="akhir_sewa"
                                    value="{{ request('akhir_sewa') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            
            <div class="card">
                <div class="card-body">
                    {{-- <a href="{{ route('backend.v_operasional.create') }}">
                        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Tambah</button>
                        </a> --}}
                    </form>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Mulai</th>
                                    <th>Akhir</th>
                                    <th>Stok Tersedia</th>
                                    {{-- <th>Aksi</th> --}}
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach ($stokLapangan as $stok)
                                    <tr>
                                        <td>{{ $stok->id }}</td>
                                        <td>{{ $stok->biaya->kelas_lapangan }}</td>
                                        <td>{{ $stok->tanggal_sewa }}</td>
                                        <td>{{ $stok->mulai_sewa }}</td>
                                        <td>{{ $stok->akhir_sewa }}</td>
                                        <td>{{ $stok->stok_tersedia }}</td>
                                        {{-- <td>
                                            <a
                                                href="{{ route('backend.v_operasional.edit', $stok->id) }}"
                                                class="btn btn-warning btn-sm">Edit </a>
                                            <form
                                                action="{{ route('backend.v_operasional.destroy', $stok->id) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                </div>
                </div>
            </div>
    </div>
@endsection
