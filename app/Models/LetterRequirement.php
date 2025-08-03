<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_request_id',
        'requirement_name',
        'file_path',
    ];

    public function request()
    {
        return $this->belongsTo(LetterRequest::class);
    }
}