<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoLapangan extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'foto_lapangan';
    protected $guarded = ['id'];
}
