<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTamaraToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("tamara_order_id")->nullable();
            $table->string("tamara_checkout_id")->nullable();
            $table->text("tamara_checkout_url")->nullable();
            $table->string("tamara_status")->nullable();
            $table->string("tamara_capture_id")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIfExists('tamara_order_id');
            $table->dropIfExists('tamara_checkout_id');
            $table->dropIfExists('tamara_checkout_url');
            $table->dropIfExists('tamara_status');
            $table->dropIfExists('tamara_capture_id');
        });
    }
}
