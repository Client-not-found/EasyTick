<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('key');
            $table->unsignedBigInteger('useId');
            $table->unsignedBigInteger('catId');
            $table->string('topic');
            $table->mediumtext('message');
            $table->timestamps();
            $table->foreign('useId')->references('key')->on('users');
            $table->foreign('catId')->references('Key')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
