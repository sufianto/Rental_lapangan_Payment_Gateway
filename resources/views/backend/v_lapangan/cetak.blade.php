<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ccc;
    }

    table tr td {
        padding: 6px;
        font-weight: normal;
        border: 1px solid #ccc;
    }

    table th {
        border: 1px solid #ccc;
    }
</style>
<table>
     {{-- <tr>
    <td align="center">
    <img src="{{ asset('images/header.png') }}" width="50%">
    </td>
    </tr>  --}}
    <tr>
        <td align="left"> Perihal : {{ $judul }} <br>
            Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}
        </td>
    </tr>
</table>
<p></p><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ccc;
        }
        table tr td, table tr th {
            padding: 6px;
            border: 1px solid #ccc;
        }
        table th {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body onload="window.print()">
    {{-- <table>
        <tr>
            <td>
                <strong>Perihal:</strong> {{ $judul }} <br>
                <strong>Periode:</strong> {{ $tanggalAwal }} s/d {{ $tanggalAkhir }}
            </td>
        </tr>
    </table> --}}
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lapangan</th>
                <th>Kelas Lapangan</th>
                <th>Biaya</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cetak as $index => $lapangan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $lapangan->nama_lapangan }}</td>
                    <td>{{ $lapangan->kelas_lapangan }}</td>
                    <td>{{ number_format($lapangan->biaya_lapangan, 0, ',', '.') }}</td>
                    <td>{{ $lapangan->stok_lapangan }}</td>
                    <td>{{ $lapangan->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>{{ $lapangan->detail }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

{{-- <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
            <tr>
                <td> {{ $loop->iteration }}</td>
                <td> {{ $row->kategori->>kelas_lapangan }} </td>
                <td>
                    @if ($row->status == 1)
                        Publis
                    @elseif($row->status == 0)
                        Blok
                    @endif
                </td>
                <td> {{ $row->nama_produk }} </td>
                <td> Rp. {{ number_format($row->harga, 0, ',', '.') }} </td>
                <td> {{ $row->stok }} </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script> --}}
