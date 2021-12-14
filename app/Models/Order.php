<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'product_id',
        'customer_id',
        'order_number',
        'order_quantity',
        'product_price',
        'product_price_currency',
        'paid_amount_currency',
        'paid_amount',
        'vat_rate',
        'txn_id',
        'payment_status',
        'card_holder',
        'stripe_id',
        'stripe_customer_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at'
    ];
    public function products()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

}
