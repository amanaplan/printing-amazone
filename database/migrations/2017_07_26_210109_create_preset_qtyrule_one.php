<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresetQtyruleOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preset_qty_rule_one', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map_prod_form_option');
            $table->integer('order_qty_frm');
            $table->integer('order_qty_to');
            $table->float('disc_rate', 4, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preset_qty_rule_one');
    }
}
