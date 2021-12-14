<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_status')->nullable();
            //$table->unsignedTinyInteger('product_categories_id');
            $table->unsignedTinyInteger('user_id');
            $table->longText('product_caption')->nullable();
            $table->longText('product_description')->nullable();
            $table->float('product_price')->default(0);
            $table->string('product_currency')->nullable();
            $table->integer('to_ping')->nullable();
            $table->string('slug')->nullable();
            $table->float('product_vat_rate')->default(0);
            $table->longText('product_mine_base64')->nullable();
            $table->longText('product_mime')->nullable();
            $table->string('product_mime_type')->nullable();
            $table->integer('product_like_count')->nullable();
            $table->integer('product_comment_count')->nullable();
            $table->string('external_link')->nullable();
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
        Schema::dropIfExists('products');
    }
}
