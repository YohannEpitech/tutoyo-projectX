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
            $table->string('title');
            $table->integer('author_id');
            $table->string('difficulty');
            $table->string('langage');
            $table->string('state');
            $table->string('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('files')->nullable();
            $table->string('ratings')->nullable()->default(0);
            $table->string('nb_ratings')->nullable()->default(0);
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
