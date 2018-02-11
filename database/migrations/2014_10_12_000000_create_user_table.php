<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\Helper;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->enum('status', [
                Helper::STATUS_ACTIVE,
                Helper::STATUS_DELETED
            ]);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
