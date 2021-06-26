<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->bigIncrements("user_id");
            $table->char("username", 60)->unique();
            $table->string("password");
            $table->string("email")->unique();
            $table->char("phone")->unique();
            $table->enum("gender", ["male", "female", "hide"]);
            $table->date('date_of_birth');
            $table->ipAddress("ip");
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
        Schema::dropIfExists("users");
    }
}
