<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\Helper;

class CreateGenerateUserLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generate_user_like', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id', 32)->primary();
            $table->string('generate_id', 32);
            $table->string('user_id', 32);
            $table->enum('isLike', [
                Helper::LIKE,
                Helper::DISLIKE
            ]);
            $table->timestamps();
        });
        Schema::table('generate_user_like', function (Blueprint $table) {
            $table->foreign('generate_id')->references('id')->on('generate')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
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
