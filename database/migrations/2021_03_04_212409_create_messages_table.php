<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('key');
            $table->unsignedBigInteger('ticId');
            $table->unsignedBigInteger('useId');
            $table->mediumtext('message');
            $table->timestamps();
            $table->foreign('ticId')->references('Key')->on('tickets');
            $table->foreign('useId')->references('Key')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
