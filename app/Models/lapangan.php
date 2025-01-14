<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';
    protected $fillable = [
        'nama_lapangan',
        'kelas_lapangan',
        'detail',
        'status',
        'foto',
        'user_id',
    ];

    // public function biaya()
    // {
    //     return $this->hasOne(Biaya::class, 'kelas_lapangan', 'kelas_lapangan');
    // }
    public function biaya()
    {
        // return $this->hasOne(Biaya::class);
        return $this->belongsTo(Biaya::class, 'kelas_lapangan', 'kelas_lapangan');
    }

    // Relasi ke penyewa
    public function penyewas()
    {
        return $this->hasMany(Penyewa::class);
    }
    public function fotoLapangan()
{
    return $this->hasMany(FotoLapangan::class, 'lapangan_id');
}

}
