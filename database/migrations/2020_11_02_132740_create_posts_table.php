<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('score');
            $table->string('title',100);
            $table->string('body',1000);
            $table->string('image')->nullable();

            $table->foreignId('profile_id');
            $table->foreignId('category_id');
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->
                on('profiles')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->
                on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
