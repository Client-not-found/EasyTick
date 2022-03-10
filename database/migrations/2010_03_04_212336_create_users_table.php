<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('key');
            $table->unsignedBigInteger('groId');
            $table->string('username');
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('street');
            $table->string('zip');
            $table->string('city');
            $table->string('state');
            $table->string('mail');
            $table->timestamps();
            $table->foreign('groId')->references('Key')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
