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
        'cat_url',
    ];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'categories_id');
    }

    public function submenus()
    {
        return $this->hasMany(SubMenu::class, 'category')->where('status', 1)->orderBy('title', 'asc');
    }

}
