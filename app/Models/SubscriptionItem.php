<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Cashier\Subscription as CashierSubscription;

class SubscriptionItem extends CashierSubscription
{
    use HasFactory;
    protected $table = 'subscription_items';
    protected $fillable = [
        'subscription_id',
        'stripe_id',
        'stripe_plan',
        'quantity'
    ];
}
