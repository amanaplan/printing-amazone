<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresetQtyruleTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preset_qty_rule_two', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map_prod_form_option');
            $table->integer('every_extra_qty');
            $table->integer('from');
            $table->integer('to')->nullable();
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
        Schema::dropIfExists('preset_qty_rule_two');
    }
}
