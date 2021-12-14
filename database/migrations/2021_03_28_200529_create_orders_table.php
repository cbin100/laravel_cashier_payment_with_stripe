<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('order_number')->nullable();
            $table->integer('order_quantity')->nullable();
            $table->float('product_price')->nullable();
            $table->string('product_price_currency')->nullable();
            $table->string('paid_amount_currency')->nullable();
            $table->float('paid_amount')->nullable();
            $table->float('vat_rate')->nullable();
            $table->string('txn_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('card_holder')->nullable();
            // Migrations Cushier Stripe
            $table->string('stripe_id')->nullable()->index();
            $table->string('stripe_customer_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
