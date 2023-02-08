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
        Schema::create('estate_sponsor', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id');
            $table->foreign('estate_id')->references('id')->on('estates')->cascadeOnDelete();
            
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->cascadeOnDelete();

            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->primary(['estate_id','sponsor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_sponsor');
    }
};
