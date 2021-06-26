<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->char("username", 60)->primary();
            $table->string("nickname", 100)->nullable();
            $table->text("bio")->nullable();
            $table->boolean("show_email")->default(true);
            $table->boolean("show_phone")->default(false);
            $table->string("facebook")->nullable();
            $table->string("twitter")->nullable();
            $table->boolean("dark_mode")->default(false);
            $table->enum("permission", ["member", "author", "moderator", "administrator"])->default("member");
            $table->char("signature", 20)->nullable();
            $table->timestamp("sent_mail_activation_at")->nullable();
            $table->timestamp("active_at")->nullable();
            $table->boolean("active")->default(false);
            $table->boolean("block")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
