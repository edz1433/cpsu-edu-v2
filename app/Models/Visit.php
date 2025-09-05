<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    // Columns that are mass assignable
    protected $fillable = [
        'page',
        'ip_address',
        'session_id',
        'user_agent',
        'last_seen_at',
    ];

    // Optional: treat last_seen_at as Carbon instance
    protected $dates = [
        'last_seen_at',
        'created_at',
        'updated_at',
    ];
}
