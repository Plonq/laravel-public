<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('time');
            $table->timestamps();

            $table->integer('movie_id')->unsigned();
            $table->foreign('movie_id')->references('id')->on('movies');

            $table->integer('cinema_id')->unsigned();
            $table->foreign('cinema_id')->references('id')->on('cinemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
