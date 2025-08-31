<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingDisclosureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainingdisclosure', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
			$table->string("email")->nullable();
			$table->string("phone")->nullable();
			$table->string("country")->nullable();
			$table->string("company")->nullable();
			$table->string("numberoftrainees")->nullable();
			$table->string("websiteurl")->nullable();
			$table->string("service")->nullable();
			$table->string("title")->nullable();

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
        Schema::dropIfExists('trainingdisclosure');
    }
}
