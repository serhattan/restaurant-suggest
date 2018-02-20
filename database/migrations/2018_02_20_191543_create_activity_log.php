<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->string('id', 32);
            $table->string('group_id', 32);
            $table->string('user_id', 32);
            $table->enum('action', [
                Helper::ADD,
                Helper::UPDATE,
                Helper::REMOVE,
                Helper::GENERATE,
            ]);
            $table->enum('related_table', [
                Helper::USER_TABLE,
                Helper::RESTAURANT_USER_TABLE,
                Helper::RESTAURANT_TABLE,
                Helper::GROUP_USER_TABLE,
                Helper::GROUP_MEMBER_TABLE,
                Helper::GROUP_TABLE,
                Helper::GENERATE_TABLE,
            ]);
            $table->string('item_id');
            $table->string('message')->nullable();
            $table->timestamps();
        });
        Schema::table('activity_log', function (Blueprint $table) {
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
        //
    }
}
