<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromToBusinessgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businessgroups', function (Blueprint $table) {
            $table->datetime("from")->nullable();
            $table->datetime("to")->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businessgroups', function (Blueprint $table) {
            $table->dropIfExists('from');
            $table->dropIfExists('to');

        });
    }
}
