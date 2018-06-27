<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics' , function(Blueprint $table){
            $table->increments('id');
            $table->string('tag');
            $table->string('Song_name');
            $table->integer('artist_id')->length(10)->unsigned();
            $table->integer('album_id')->length(10)->unsigned();
            $table->string('song_file'); 
            $table->string('language');
            $table->bigInteger('count');
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
        Schema::dropIfExists('musics');
    }
}
