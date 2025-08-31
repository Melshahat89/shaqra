<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchemaToBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string("schema")->nullable();
            $table->string("author")->nullable();
            $table->string("metatitle")->nullable();
            $table->string("metadescription")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIfExists('schema');
            $table->dropIfExists('author');
            $table->dropIfExists('metatitle');
            $table->dropIfExists('metadescription');
        });
    }
}
