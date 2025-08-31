<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalcertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionalcertificates', function (Blueprint $table) {
            $table->increments('id');
            $table->date("startdate")->nullable();
			$table->boolean("appointment")->nullable();
			$table->integer("days")->nullable();
			$table->float("hours")->nullable();
			$table->integer("seats")->nullable();
			$table->date("registrationdeadline")->nullable();
			
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
        Schema::dropIfExists('professionalcertificates');
    }
}
