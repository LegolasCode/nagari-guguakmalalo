<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulasiTernak extends Model
{
    use HasFactory;

    protected $table = 'populasi_ternak';
    protected $fillable = [
        'jenis_ternak',
        'jumlah_duo_koto',
        'jumlah_guguak',
        'jumlah_baiang',
        'tahun',
        'user_id',
        'image',
    ];
    public function user() { return $this->belongsTo(User::class); }
}