<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresetNamePhotoStickerPricing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preset_name_photo_sticker', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('sticker_type');
            $table->integer('quantity_id');
            $table->double('price', 15, 2);
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
        Schema::dropIfExists('preset_name_photo_sticker');
    }
}
