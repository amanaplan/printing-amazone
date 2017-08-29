<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_billing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('country_fips');
            $table->string('state');
            $table->string('city');
            $table->string('zipcode');
            $table->text('street');
            $table->string('company')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_billing');
    }
}
