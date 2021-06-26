<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements("post_id");
            $table->unsignedBigInteger("user_id");
            $table->string("title")->unique();
            $table->string("slug")->unique();
            $table->longText("content");
            $table->longText("thumbnail");
            $table->unsignedBigInteger("views")->default(0);
            $table->unsignedBigInteger("category_id");
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
        Schema::dropIfExists('posts');
    }
}
