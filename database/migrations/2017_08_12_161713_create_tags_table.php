<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tags", function (Blueprint $table) {
            $table->id();
            $table->string("name"); // tags just need a name property, don't need timestamps
        });

        Schema::create("article_tag", function (Blueprint $table) {
            $table->id();
            $table->foreignId("article_id")->unsigned();
            $table->foreignId("tag_id")->unsigned();

            $table->foreign("article_id")->references("id")->on("articles")->onDelete("cascade");
            $table->foreign("tag_id")->references("id")->on("tags")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("article_tag");
        Schema::drop("tags");
    }
}
