<?php

namespace App\Jobs;

use App\Models\Penyewa;
use App\Models\StokLapangan;
use App\Models\Biaya;
use Illuminate\Support\Carbon;

class RestoreStockJob
{
    // public function handle()
    // {
    //     $penyewaSelesai = Penyewa::where('akhir_sewa', '<=', now())
    //         ->where('status_bayar', 1) // Pastikan penyewa sudah membayar
    //         ->get();

    //     foreach ($penyewaSelesai as $penyewa) {
    //         // Kembalikan stok
    //         StokLapangan::where('biaya_id', $penyewa->lapangan->biaya_id)
    //             ->where('tanggal_sewa', $penyewa->mulai_sewa->format('Y-m-d'))
    //             ->increment('stok_tersedia', $penyewa->stok_lapangan);

    //         // Tandai bahwa stok telah dikembalikan
    //         $penyewa->update(['status_bayar' => 2]); // Misalnya, status 2 berarti selesai
    //     }
    // }

    public function handle()
    {
        // Ambil data penyewa yang telah selesai sewa
        $penyewaSelesai = Penyewa::where('akhir_sewa', '<=', now())
            // ->where('status_bayar', 1) // Hanya yang sudah dibayar
            ->get();

        foreach ($penyewaSelesai as $penyewa) {
            // Kembalikan stok pada tabel StokLapangan
            StokLapangan::where('biaya_id', $penyewa->biaya->biaya_id)
                ->where('tanggal_sewa', $penyewa->mulai_sewa->format('Y-m-d'))
                ->increment('stok_tersedia', $penyewa->stok_lapangan);

            // Kembalikan stok pada tabel Biaya
            Biaya::where('id', $penyewa->biaya->biaya_id)
                ->increment('stok_lapangan', $penyewa->stok_lapangan);

            // Tandai bahwa stok telah dikembalikan
            $penyewa->update(['status_bayar' => 2]); // Misalnya, status 2 berarti selesai
            
        // Redirect ke halaman penyewa dengan notifikasi sukses
        return redirect()->route('backend.penyewa.index')
        ->with('success', 'Stok telah dikembalikan dan penyewaan selesai.');
        }
    }

}
