<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenerateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generate', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->string('restaurant_id', 32);
            $table->string('group_id', 32);
            $table->integer('budget');
            $table->dateTime('date');
            $table->timestamps();
        });

        Schema::table('generate', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('group');
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
        Schema::dropIfExists('generate');
    }
}
