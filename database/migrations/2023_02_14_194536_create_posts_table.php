<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('category_id')->nullable();

//            $table->foreign('category_id', 'post_category_fk')->on('categories')->references('id');
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->index('category_id', 'post_category_idx');
            $table->foreign('category_id', 'post_category_fk')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('post_category_fk');
        });

        Schema::dropIfExists('posts');
    }
};
