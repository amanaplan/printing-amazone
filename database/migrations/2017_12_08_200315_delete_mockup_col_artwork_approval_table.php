<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteMockupColArtworkApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_artwork_approval', function (Blueprint $table) {
            $table->dropColumn(['mockup']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_artwork_approval', function (Blueprint $table) {
            $table->string('mockup')->after('order_item_id');
        });
    }
}
