<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) 
        {
            $table->id();
            $table->string('body',200);

            $table->foreignId('profile_id');
            $table->foreignId('post_id');
            $table->timestamps();
            
            $table->foreign('profile_id')->references('id')->
                on('profiles')->onDelete('cascade')->onUpdate('cascade');
                
            $table->foreign('post_id')->references('id')->
                on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
