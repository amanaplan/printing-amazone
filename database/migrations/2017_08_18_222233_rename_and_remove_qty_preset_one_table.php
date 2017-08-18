<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAndRemoveQtyPresetOneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preset_qty_rule_one', function (Blueprint $table) {
            $table->renameColumn('order_qty_frm', 'order_qty');
            $table->dropColumn('order_qty_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preset_qty_rule_one', function (Blueprint $table) {
            $table->renameColumn('order_qty', 'order_qty_frm');
        });
    }
}
