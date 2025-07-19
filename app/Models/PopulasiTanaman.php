<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulasiTanaman extends Model
{
    use HasFactory;

    protected $table = 'populasi_tanaman';
    protected $fillable = [
        'nama_komoditi',
        'tipe_tanaman',
        'jumlah_duo_koto',
        'jumlah_guguak',
        'jumlah_baiang',
        'tahun',
        'user_id',
    ];

    public function user() { return $this->belongsTo(User::class); }
}