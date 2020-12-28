<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_category', function (Blueprint $table) 
        {
           $table->primary(['admin_id','category_id']);

           $table->foreignId('admin_id');
           $table->foreignId('category_id');
           $table->timestamps();

           $table->foreign('admin_id')->references('id')->
               on('admins')->onDelete('cascade')->onUpdate('cascade');
           
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
        Schema::dropIfExists('admin_category');
    }
}
