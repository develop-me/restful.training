<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 20);
            $table->string("key", 40);
            $table->timestamps();
        });

        Schema::table('articles', function (Blueprint $table) {
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(["account_id"]);
            $table->dropColumn("account_id");
        });

        Schema::dropIfExists('accounts');
    }
}
