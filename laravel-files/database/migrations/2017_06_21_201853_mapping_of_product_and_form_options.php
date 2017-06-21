<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MappingOfProductAndFormOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_prod_form_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mapping_field_id')->comment('mapping id of map_prod_form table');
            $table->integer('option_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_prod_form_options');
    }
}
