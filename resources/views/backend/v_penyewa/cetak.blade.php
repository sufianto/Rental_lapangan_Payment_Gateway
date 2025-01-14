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
{{-- <h1>{{ $judul }}</h1>
<p>Periode: {{ $tanggalAwal }} - {{ $tanggalAkhir }}</p> --}}
<td align="left">
    Perihal : {{ $judul }} <br>
    Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}
</td>

<table border="1">
    <thead>
        <tr>
            <th>ID Penyewa</th>
            <th>Nama Penyewa</th>
            <th>Lapangan</th>
            <th>Mulai Sewa</th>
            <th>Akhir Sewa</th>
            <th>Total Biaya</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $penyewa)
        <tr>
            <td>{{ $penyewa->id }}</td>
            <td>{{ $penyewa->nama_penyewa }}</td>
            <td>{{ $penyewa->lapangan->nama_lapangan }}</td>
            <td>{{ $penyewa->mulai_sewa }}</td>
            <td>{{ $penyewa->akhir_sewa }}</td>
            <td>{{ $penyewa->total_biaya }}</td>
            <td>{{ $penyewa->status_bayar == 1 ? 'Lunas' : 'Belum Lunas' }}</td>
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
</script>
<!-- Add button to print the page -->
{{-- <button onclick="window.print()">Print</button> --}}
