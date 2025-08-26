<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = 'submenus';

    protected $fillable = [
        'title',
        'content',
        'category',
        'subcategory',
        'url',
        'menu_order',
        'thumbnail',
        'visit',
        'status',
    ];
}
