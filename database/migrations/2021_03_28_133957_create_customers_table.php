<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('login')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->float('balance')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('admin')->nullable();
            $table->string('role', 100)->nullable();
            $table->tinyInteger('permission')->nullable();
            $table->string('card_holder')->nullable();
            $table->rememberToken();
            $table->timestamps();

             // Migrations Cushier Stripe

            $table->string('stripe_id')->nullable()->index();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        /* Migrations Cushier Stripe
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_id',
                'card_brand',
                'card_last_four',
                'trial_ends_at',
            ]);
        });
        */
    }
}
