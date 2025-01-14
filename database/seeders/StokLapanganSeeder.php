<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lapangan;
use App\Models\Biaya;
use App\Models\StokLapangan;
use Carbon\Carbon;

class StokLapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua data lapangan
        $lapangan = Lapangan::all();
    
        foreach ($lapangan as $l) {
            // Ambil data biaya berdasarkan kelas lapangan
            $biaya = Biaya::where('kelas_lapangan', $l->kelas_lapangan)->first();
    
            if (!$biaya) {
                continue; // Lewati jika tidak ada data biaya untuk kelas ini
            }
    
            // Ambil tanggal yang ingin diinput (misalnya, 7 hari ke depan dari sekarang)
            $startDate = Carbon::now(); // Tanggal sekarang
            $endDate = $startDate->copy()->addDays(30); // Atur tanggal sampai 7 hari ke depan
    
            // Loop untuk memasukkan stok lapangan setiap hari
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                // Asumsikan lapangan buka dari jam 08:00 hingga 22:00
                for ($i = 8; $i < 23; $i++) {
                    StokLapangan::create([
                        'biaya_id' => $biaya->id,
                        'tanggal_sewa' => $date->format('Y-m-d'),
                        'mulai_sewa' => Carbon::createFromTime($i, 0, 0),
                        'akhir_sewa' => Carbon::createFromTime($i + 1, 0, 0),
                        'stok_tersedia' => $biaya->stok_lapangan, // Awal stok diambil dari tabel biaya
                    ]);
                }
            }
        }
    }
    
}
