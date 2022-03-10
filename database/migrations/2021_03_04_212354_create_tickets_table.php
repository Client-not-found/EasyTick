<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('key');
            $table->unsignedBigInteger('useId');
            $table->unsignedBigInteger('depId');
            $table->string('subject');
            $table->string('status');
            $table->timestamps();
            $table->foreign('useId')->references('Key')->on('users');
            //$table->foreign('ticDepId')->references('depKey')->on('departements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
