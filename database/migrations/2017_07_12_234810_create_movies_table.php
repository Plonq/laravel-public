<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('release_date');
            $table->boolean('featured');
            $table->string('poster_image_url');
            $table->string('cover_image_url');
            $table->timestamps();

            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres');

            $table->integer('rating_id')->unsigned();
            $table->foreign('rating_id')->references('id')->on('ratings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
