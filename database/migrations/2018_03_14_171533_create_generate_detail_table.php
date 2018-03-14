<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenerateDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generate_detail', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->string('restaurant_id', 32);
            $table->string('group_id', 32);
            $table->float('total_score');
            $table->integer('order_no');
            $table->string('data');
            $table->boolean('regenerate_status');
            $table->enum('status', [
                Helper::STATUS_ACTIVE,
                Helper::STATUS_DELETED
            ]);
            $table->timestamps();
        });
        Schema::table('generate_detail', function (Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('restaurant');
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
        Schema::dropIfExists('generate_detail');
    }
}
