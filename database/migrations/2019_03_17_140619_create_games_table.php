<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('winning_score')->default(21);
            $table->integer('change_serve')->default(5);
            $table->string('player_1', 50);
            $table->string('player_2', 50);
            $table->integer('player_1_score')->default(0);
            $table->integer('player_2_score')->default(0);
            $table->timestamps();

            $table->foreignId("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
