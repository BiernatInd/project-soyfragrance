<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 8, 2);
            $table->decimal('promo_price', 8, 2)->nullable();
            $table->integer('availability')->unsigned(); //stan magazynowy
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('product_photo_1')->nullable();
            $table->string('product_photo_2')->nullable();
            $table->string('product_photo_3')->nullable();
            $table->string('product_title')->nullable();
            $table->text('product_description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}