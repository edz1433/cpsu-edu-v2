<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_id',
        'title',
    ];

    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'subcategory');
    }

}
