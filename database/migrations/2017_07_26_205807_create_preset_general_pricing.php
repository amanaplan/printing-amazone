<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresetGeneralPricing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preset_general', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map_prod_form_option');
            $table->integer('from');
            $table->integer('to');
            $table->float('val_per_mmsq', 4, 2)->nullable();
            $table->float('profit_percent', 4, 2)->nullable();
            $table->integer('min_size');
            $table->integer('max_size');
            $table->tinyInteger('is_base')->default(0);
            $table->float('base_price', 4, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preset_general');
    }
}
