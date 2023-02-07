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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('type');
            $table->tinyInteger('room_number');
            $table->tinyInteger('bed_number');
            $table->tinyInteger('bathroom_number');
            $table->string('detail')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->string('mq')->nullable();
            $table->string('cover_img');
            $table->boolean('is_visible');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('estates');
    }
};
