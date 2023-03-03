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

            $table->string('name');
            $table->string('slug');

            // Le colocamos nullable para poder guardar borradores de posts
            $table->text('extract')->nullable();
            $table->longText('body')->nullable();

            $table->enum('status', [1, 2])->default(1);

            // relacionar con tabla usuarios y categoria
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            // Restriccion de clave foranea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
};