<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = ['title', 'content', 'user_id', 'slug', 'parent_category'];

    public function products()
    {
        //return $this->hasMany(\App\Models\Product::class);
        return $this->hasMany(Product::class, 'product_categories_id');
    }

    public function productCategoryUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
