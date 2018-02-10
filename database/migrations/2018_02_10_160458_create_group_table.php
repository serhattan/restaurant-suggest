<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\Helper;

class CreateGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->string('name', 120);
            $table->string('created_by', 32);
            $table->integer('budget');
            $table->enum('status', [
                Helper::STATUS_ACTIVE,
                Helper::STATUS_DELETED
            ]);
            $table->timestamps();
        });
        Schema::table('group', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group');
    }
}
