<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTabyToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("tabby_order_id")->nullable();
            $table->string("tabby_order_status")->nullable();
            $table->string("tabby_checkout_url")->nullable();
            $table->string("tabby_order_warnings")->nullable();
            $table->string("tabby_payment_id")->nullable();
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
            $table->dropIfExists('tabby_order_id');
            $table->dropIfExists('tabby_order_status');
            $table->dropIfExists('tabby_checkout_url');
            $table->dropIfExists('tabby_order_warnings');
            $table->dropIfExists('tabby_payment_id');
        });
    }
}
