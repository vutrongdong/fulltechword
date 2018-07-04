<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->index();
            $table->string('image')->nullable();
            $table->string('teaser');
            $table->text('content');
            $table->boolean('active')->default(true);
            $table->tinyInteger('hot')->default(false);
            $table->integer('category_id')->unsigned()->index();
            $table->integer('author_id')->unsigned()->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
