<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'ip_address',
        'user_agent',
        'last_seen_at',
    ];

    protected $dates = ['last_seen_at'];
}
