<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->string('activity_id', 32);
            $table->string('group_id', 32);
            $table->string('user_id', 32);
            $table->string('helper_id');
            $table->string('content')->nullable();
            $table->timestamps();
        });
        Schema::table('activity_log', function (Blueprint $table) {
            $table->foreign('activity_id')->references('id')->on('activity');
            $table->foreign('user_id')->references('id')->on('user');
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
        Schema::dropIfExists('activity_log');
    }
}
