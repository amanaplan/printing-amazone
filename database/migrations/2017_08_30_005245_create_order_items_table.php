<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('paperstock');
            $table->string('width');
            $table->string('height');
            $table->string('qty');
            $table->decimal('price', 15, 2);
            $table->string('sticker_type')->nullable();
            $table->string('laminating')->nullable();
            $table->string('sticker_name')->nullable();
            $table->string('artwork')->nullable();
            $table->text('instructions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
