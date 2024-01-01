<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPrivatePersonTable extends Migration
{
    public function up()
    {
        Schema::create('order_private_person', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone', 15);
            $table->string('country');
            $table->string('street_and_house_number');
            $table->string('place');
            $table->string('postal_code');
            $table->string('invoice_name')->nullable();
            $table->string('invoice_surname')->nullable();
            $table->string('invoice_street_and_house_number')->nullable();
            $table->string('invoice_place')->nullable();
            $table->string('invoice_postal_code')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('payment')->nullable();
            $table->string('delivery')->nullable();
            $table->string('order_status')->default('Nieopłacono');
            $table->string('order_number')->nullable();
            $table->string('entered_promo_code')->nullable();
            $table->integer('discount')->nullable();
            $table->text('purchased_products')->nullable();
            $table->string('user_name')->nullable();
            $table->string('paczkomat_number')->nullable();
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_private_person');
    }
}