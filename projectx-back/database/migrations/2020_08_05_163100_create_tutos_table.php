<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutos', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('title')->unique();
            $table->integer('author_id');

            $table->string('difficulty')->nullable();
            $table->string('langage')->nullable();
            $table->integer('state');
            $table->string('summary')->nullable();
            $table->string('content')->nullable();

            $table->string('pathImg')->nullable();
            $table->string('files')->nullable();
            $table->string('ratings')->nullable();
            $table->string('nb_ratings')->nullable();
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
        Schema::dropIfExists('tutos');
    }
}
