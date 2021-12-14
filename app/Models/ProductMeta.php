<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;
    protected $table = 'product_metas';
    protected $fillable = ['product_id', 'product_parent_id', 'meta_key', 'meta_value'];
    protected $attributes = [
        'meta_key' => '',
        //'post_id' => 55,
        //'post_parent_id' => 20,
        'meta_value' => '',

    ];
    public function productMetas()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
