<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\Helper;

class CreateGroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->string('group_id', 32);
            $table->string('user_id', 32);
            $table->boolean('is_admin')->default('0');
            $table->enum('status', [
                Helper::STATUS_ACTIVE,
                Helper::STATUS_DELETED
            ]);
            $table->timestamps();
        });

        Schema::table('group_user', function (Blueprint $table) {
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
        Schema::dropIfExists('group_user');
    }
}
