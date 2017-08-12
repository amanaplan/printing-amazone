<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialProductsReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_special', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('special_product_id');
            $table->integer('user_id');
            $table->string('title',191);
            $table->text('description');
            $table->decimal('rating', 4, 1);
            $table->integer('publish')->default(0);
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
        Schema::dropIfExists('review_special');
    }
}
