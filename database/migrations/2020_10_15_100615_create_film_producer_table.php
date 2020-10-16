<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmProducerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_producer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Film_id');
            $table->unsignedBigInteger('Producer_id');

            $table->foreign('Film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('Producer_id')->references('id')->on('actors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_producer');
    }
}
