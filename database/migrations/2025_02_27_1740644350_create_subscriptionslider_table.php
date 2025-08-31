<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptionslider', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->text("description")->nullable();
			$table->string("image")->nullable();
			$table->boolean("status")->nullable();
			$table->string("cta_text")->nullable();
			$table->string("cta_link")->nullable();
			
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
        Schema::dropIfExists('subscriptionslider');
    }
}
