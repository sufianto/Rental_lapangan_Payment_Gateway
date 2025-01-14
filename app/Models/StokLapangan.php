<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokLapangan extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sama dengan nama model dalam snake_case)
    protected $table = 'stok_lapangan';

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'biaya_id',
        'tanggal_sewa',
        'mulai_sewa',
        'jam_akhir',
        'akhir_Sewa',
    ];
  
    // Relasi ke tabel Biaya
    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'biaya_id');
    }
    public function penyewa()
{
    return $this->belongsToMany(Penyewa::class, 'penyewaan_stok');
}

}
