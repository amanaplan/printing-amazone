<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditioalProfileInfoColToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('photo');
            $table->string('birthday')->nullable()->after('mobile');
            $table->string('state')->nullable()->after('birthday');
            $table->string('suburb')->nullable()->after('state');
            $table->string('post_code')->nullable()->after('suburb');
            $table->string('street')->nullable()->after('post_code');
            $table->string('company')->nullable()->after('street');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Users', function (Blueprint $table) {
            $table->dropColumn('mobile');
            $table->dropColumn('birthday');
            $table->dropColumn('state');
            $table->dropColumn('suburb');
            $table->dropColumn('post_code');
            $table->dropColumn('street');
            $table->dropColumn('company');
        });
    }
}
