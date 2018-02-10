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
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->string('restaurant_id', 32);
            $table->string('user_id', 32);
            $table->integer('budget');
            $table->timestamps();
        });

        Schema::table('restaurant_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user');
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
