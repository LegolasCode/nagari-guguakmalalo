<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    protected $guarded = [];

    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'religion',
        'marital_status',
        'occupation',
        'phone',
        'status_active',
        'bpjs_status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
