<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->enum('name', [
                Helper::ADD,
                Helper::UPDATE,
                Helper::REMOVE,
                Helper::GENERATE,
            ]);
            $table->enum('table', [
                Helper::USER_TABLE,
                Helper::RESTAURANT_USER_TABLE,
                Helper::RESTAURANT_TABLE,
                Helper::GROUP_USER_TABLE,
                Helper::GROUP_MEMBER_TABLE,
                Helper::GROUP_TABLE,
                Helper::GENERATE_TABLE,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
