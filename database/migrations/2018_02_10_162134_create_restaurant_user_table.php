<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id');
            $table->integer('user_id');
            $table->integer('budget');
            $table->timestamps();
        });

        Schema::table('group_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->integer('restaurant_id')->unsigned();
            $table->foreign('restaurant_id')->references('id')->on('restaurant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_user');
    }
}
