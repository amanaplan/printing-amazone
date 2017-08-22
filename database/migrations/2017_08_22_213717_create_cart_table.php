<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cart_token');
            $table->integer('user_id')->default(0);
            $table->integer('product_id');
            $table->integer('paperstock');
            $table->float('width', 7, 2);
            $table->float('height', 7, 2);
            $table->integer('qty');
            $table->float('price', 7, 2)->default(00.00);
            $table->string('label_option')->nullable(); //exclusively for name stickers
            $table->string('sticker_name')->nullable(); //exclusively for name stickers
            $table->string('artwork')->nullable();
            $table->text('instructions')->nullable();
            $table->integer('preset_mapper');
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
        Schema::dropIfExists('cart');
    }
}
