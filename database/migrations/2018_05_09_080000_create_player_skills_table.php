<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shooting');
            $table->integer('defending');
            $table->integer('speed');
            $table->integer('dribbling');
            $table->integer('stamina');
            $table->integer('weight');
            $table->integer('height');
            $table->string('preferredFoot');
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
        Schema::dropIfExists('player_skills');
    }
}