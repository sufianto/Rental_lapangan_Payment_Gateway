<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewa';
    protected $fillable = [
        'nama_penyewa',
        'lapangan_id',
        'total_jam',
        'mulai_sewa',
        'akhir_sewa',
        'tanggal_sewa',
        'stok_lapangan',
        'biaya_lapangan',
        'total_biaya',
        'user_id',
        'status_bayar',
        'order_id', 
    ];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'lapangan_id', 'id');
    
    }
    public function jadwals()
{
    return $this->hasMany(JadwalLapangan::class, 'penyewa_id');
}
public function user()
{
    return $this->belongsTo(User::class);
}
// protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($penyewa) {
//         // Generate order_id unik
//         do {
//             $penyewa->order_id = 'ORD-' . strtoupper(Str::random(10));
//         } while (self::where('order_id', $penyewa->order_id)->exists());
//     });
// }
}