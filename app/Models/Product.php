<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_status',
        //'product_categories_id',
        'user_id',
        'product_caption',
        'product_description',
        'product_price',
        'product_currency',
        'product_vat_rate',
        'product_mime',
        'product_mine_base64',
        'product_mime_type',
        'product_like_count',
        'product_comment_count',
        'external_link',
        'to_ping',
        'slug',
    ];
    //protected $attributes = ['product_categories_id' => 0 ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories_id');
    }

    public function orderedProduct()
    {
        return $this->hasMany(\App\Models\Order::class, 'product_id');
    }

    public function productMeta()
    {
        return $this->hasMany(ProductMeta::class, 'product_id');
    }
}
