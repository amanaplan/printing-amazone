<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('og_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('og_desc')->nullable();
            $table->string('og_img',255)->nullable();
            $table->string('category_name')->unique();
            $table->string('category_slug')->unique();
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
        Schema::dropIfExists('category');
    }
}
