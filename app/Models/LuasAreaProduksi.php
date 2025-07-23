<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuasAreaProduksi extends Model
{
    use HasFactory;

    protected $table = 'luas_area_produksi';
    protected $fillable = [
        'nama_komoditi',
        'tipe_area',
        'luas_tanam',
        'luas_panen',
        'produksi',
        'tahun',
        'user_id',
        'image',
    ];
    protected $casts = [ // Otomatis ubah tipe data ke float
        'luas_tanam' => 'float',
        'luas_panen' => 'float',
        'produksi' => 'float',
    ];

    public function user() { return $this->belongsTo(User::class); }
}