<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Billable;
class Customer extends Model
{
    use Billable;
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'login',
        'description',
        'address',
        'balance',
        'currency',
        'admin',
        'role',
        'permission',
        'card_brand',
        'card_last_four',
        'card_holder',
        'stripe_id',
        ];


    public function orderedProductCustomer()
    {
        return $this->hasManyThrough(\App\Models\Order::class, \App\Models\Product::class);
    }
}
