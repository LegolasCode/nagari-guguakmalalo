<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'letter_service_id',
        'request_number',
        'status',
        'completed_file_path',
        'admin_notes',
    ];

    // Mengubah status menjadi label yang mudah dibaca
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'Menunggu';
            case 'processing':
                return 'Diproses';
            case 'completed':
                return 'Selesai';
            case 'rejected':
                return 'Ditolak';
            default:
                return 'Tidak Diketahui';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(LetterService::class, 'letter_service_id');
    }

    public function requirements()
    {
        return $this->hasMany(LetterRequirement::class);
    }
}