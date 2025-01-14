<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .struk-container {
            border: 1px solid #000;
            padding: 20px;
            width: 300px;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        .content table {
            width: 100%;
        }
        .content table th, .content table td {
            text-align: left;
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <center>

   
    <div class="struk-container">
        <div class="header">
            <h2>Struk Pembayaran</h2>
            <p>{{ $tanggal_cetak }}</p>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>No Order</th>
                    <td>{{ $penyewa->order_id }}</td>
                </tr>
                <tr>
                    <th>Nama Penyewa</th>
                    <td>{{ $penyewa->nama_penyewa }}</td>
                </tr>
                <tr>
                    <th>Lapangan</th>
                    <td>{{ $penyewa->lapangan->nama_lapangan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pesan</th>
                    <td>{{ $penyewa->stok_lapangan }} lapangan</td>
                </tr>
                
                <tr>
                    <th>Total Jam</th>
                    <td>{{ $penyewa->total_jam }} jam</td>
                </tr>
                <tr>
                    <th>Jam bermain</th>
                    <td>{{ \Carbon\Carbon::parse($penyewa->mulai_sewa)->format('H:i') }}-{{ \Carbon\Carbon::parse($penyewa->akhir_sewa)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>Biaya</th>
                    <td>Rp {{ $penyewa->biaya_lapangan }} /jam</td>
                </tr>
                
                <tr>
                    <th>Total Biaya</th>
                    <td>Rp {{ number_format($penyewa->total_biaya, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($penyewa->status_bayar == 1)
                            Lunas
                        @elseif ($penyewa->status_bayar == 0)
                            Pending
                        @else
                            Gagal
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
    <script>
        // window.print();

        window.onload = function() {
        printStruk();
    }

    function cetakstruk() {
        window.print();
    }
    </script>
</body>
</center>
</html>
