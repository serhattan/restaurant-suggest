<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('name', 32);
            $table->enum('status', [
                Helper::STATUS_ACTIVE,
                Helper::STATUS_DELETED
            ]);
            $table->float('average_price');
            $table->timestamps();
        });

        Schema::table('group', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant');
    }
}
