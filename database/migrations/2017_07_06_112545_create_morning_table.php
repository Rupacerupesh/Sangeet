<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMorningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mornings' , function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('Rock');
            $table->integer('Pop');
            $table->integer('Metal');
            $table->integer('Bhajan');
            $table->integer('Alternative');
            $table->integer('Dance');
            $table->integer('RnB');
            $table->integer('HipHop');
            $table->integer('Country');
            $table->integer('Classic');
            $table->integer('Instrumental');
            $table->integer('Romance');
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
        Schema::dropIfExists('morning');
    }
}
