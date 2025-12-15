<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    
    // Izinkan mass assignment
    protected $fillable = [
        'title', 
        'slug', 
        'excerpt', 
        'content', 
        'author', 
        'image', 
        'status'
    ];
}