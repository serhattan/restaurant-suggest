<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_member', function (Blueprint $table) {
            $table->string('id', 32);
            $table->string('group_id', 32);
            $table->string('email');
            $table->string('invitor_id', 32);
            $table->timestamps();
        });
        Schema::table('group_member', function (Blueprint $table) {
            $table->foreign('invitor_id')->references('id')->on('user');
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
        Schema::dropIfExists('group_member');
    }
}
