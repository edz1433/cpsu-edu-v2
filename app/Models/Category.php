<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'cat_name',
        'hasgrid',
    ];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'categories_id');
    }

    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'category');
    }

}
