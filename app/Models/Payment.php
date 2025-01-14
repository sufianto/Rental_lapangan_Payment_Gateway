<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'penyewa_id', 'payment_code', 'total_amount', 'payment_status',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }
}
