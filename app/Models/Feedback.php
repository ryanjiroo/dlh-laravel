<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'message',
        'is_read',
    ];

    // Tentukan nama tabel jika berbeda dari konvensi
    protected $table = 'feedback';
}