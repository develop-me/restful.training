<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_facts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fact', 255);
            $table->boolean('made_up');
            $table->timestamps();

            $table->integer("account_id")->unsigned();
            $table->foreign("account_id")->references("id")->on("accounts");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_facts');
    }
}
