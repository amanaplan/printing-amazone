<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_special', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('og_img',255)->nullable();
            $table->string('product_name')->unique();
            $table->string('product_slug')->unique();
            $table->string('logo');
            $table->text('description');
            $table->string('sample_image')->nullable();
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
        Schema::dropIfExists('product_special');
    }
}
