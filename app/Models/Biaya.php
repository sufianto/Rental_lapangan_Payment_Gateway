<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "biaya";
    protected $guarded = ['id'];
    public function lapangan()
{
    return $this->hasMany(Lapangan::class, 'kelas_lapangan', 'kelas_lapangan');
}    
public static function resetDailyStock()
{
    $today = now()->format('Y-m-d');

    self::where('last_reset', '!=', $today)
        ->update([
            'stok_lapangan' => DB::raw('stok_lapangan + jumlah_awal'),
            'last_reset' => $today,
        ]);
}
}
